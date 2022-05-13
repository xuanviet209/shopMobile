<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\OrderDetail;
use Mail;
use Carbon\Carbon;

class CheckoutController extends Controller
{
  public function __construct()
  {
    $this->middleware('cus');
  }
  public function form()
  {
    $cart = \Cart::content();
    return view('frontend.checkout.form', [
      'cart' => $cart
    ]);
  }

  public function success()
  {
    return view('frontend.checkout.success');
  }

  public function submitForm(Request $request, Cart $cart)
  {
    // $coupon = Coupon::where('coupon_code')->first();
    // $coupon->coupon_time = $coupon->coupon_time - 1;
    // $coupon->save();
    $cart = \Cart::content()->toArray(); // lấy ra giỏ hàng
    $customer_id = Auth::guard('cus')->user()->id;
    $customerEmail = Auth::guard('cus')->user()->email;
    $customerName = Auth::guard('cus')->user()->name;
    if ($order = Order::create([
      'customer_id' => $customer_id,
      'orders_note' => $request->orders_note,
      'customerName' => $customerName,
    ])) {
      $orders_id = $order->id;
      foreach ($cart as $products_id => $item) {
        $products_id = $item['id']; //lấy ra id
        $quantity = $item['qty'] ?? '';
        $price = $item['price'] * $item['qty'] ?? '';
        OrderDetail::create([
          'orders_id' => $orders_id,
          'products_id' => $products_id,
          'price' => $price,
          'quantity' => $quantity
        ]);
      }
      Mail::send('frontend.email.order', [
        'order' => $order,
        'cart' => $cart,
        'name' => $customerName
      ], function ($mail) use ($customerEmail, $customerName) {
        $mail->from('vietd8k11@gmail.com');
        $mail->to($customerEmail, $customerName);
        $mail->subject('Email Orders');
      });
      session(['cart' => '']);
      return redirect()->route('fr.checkout.success')->with('success');
    } else {
      return redirect()->back()->with('error', 'Đặt hàng không thành công');
    }
  }

  public function checkCoupon(Request $request)
  {
    $data = $request->all();
    $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
    if ($coupon) {
      $count_coupon = $coupon->count();
      if ($count_coupon > 0) {
        $coupon_session = Session::get('coupon');
        if ($coupon_session == true) {
          $is_avaiable = 0;
          if ($is_avaiable == 0) {
            $cou[] = array(
              'coupon_code' => $coupon->coupon_code,
              'coupon_condition' => $coupon->coupon_condition,
              'coupon_number' => $coupon->coupon_number,
            );
            Session::put('coupon', $cou);
          }
        } else {
          $cou[] = array(
            'coupon_code' => $coupon->coupon_code,
            'coupon_condition' => $coupon->coupon_condition,
            'coupon_number' => $coupon->coupon_number,
          );
          Session::put('coupon', $cou);
        }
        Session::save();
        return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
      }
    } else {
      return redirect()->back()->with('message', 'Thêm mã giảm giá không thành công');
    }
  }

  public function vnpay_payment()
  {
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "https://localhost/checkout";
    $vnp_TmnCode = "RLO464ED"; //Mã website tại VNPAY 
    $vnp_HashSecret = "KCKUYJLCKLYOYMFWTPQNPWNKQCYCXESC"; //Chuỗi bí mật

    $vnp_TxnRef = '1234'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = 'Thanh toán đơn hàng test';
    $vnp_OrderType = 'billPayment';
    $vnp_Amount = 20000 * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    // $vnp_ExpireDate = $_POST['txtexpire'];
    //Billing
    // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
    // $vnp_Bill_Email = $_POST['txt_billing_email'];
    // $fullName = trim($_POST['txt_billing_fullname']);
    // if (isset($fullName) && trim($fullName) != '') {
    //   $name = explode(' ', $fullName);
    //   $vnp_Bill_FirstName = array_shift($name);
    //   $vnp_Bill_LastName = array_pop($name);
    // }
    // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
    // $vnp_Bill_City = $_POST['txt_bill_city'];
    // $vnp_Bill_Country = $_POST['txt_bill_country'];
    // $vnp_Bill_State = $_POST['txt_bill_state'];
    // // Invoice
    // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
    // $vnp_Inv_Email = $_POST['txt_inv_email'];
    // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
    // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
    // $vnp_Inv_Company = $_POST['txt_inv_company'];
    // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
    // $vnp_Inv_Type = $_POST['cbo_inv_type'];
    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef
      // "vnp_ExpireDate" => $vnp_ExpireDate,
      // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
      // "vnp_Bill_Email" => $vnp_Bill_Email,
      // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
      // "vnp_Bill_LastName" => $vnp_Bill_LastName,
      // "vnp_Bill_Address" => $vnp_Bill_Address,
      // "vnp_Bill_City" => $vnp_Bill_City,
      // "vnp_Bill_Country" => $vnp_Bill_Country,
      // "vnp_Inv_Phone" => $vnp_Inv_Phone,
      // "vnp_Inv_Email" => $vnp_Inv_Email,
      // "vnp_Inv_Customer" => $vnp_Inv_Customer,
      // "vnp_Inv_Address" => $vnp_Inv_Address,
      // "vnp_Inv_Company" => $vnp_Inv_Company,
      // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
      // "vnp_Inv_Type" => $vnp_Inv_Type
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
      $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }

    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
      'code' => '00', 'message' => 'success', 'data' => $vnp_Url
    );
    if (isset($_POST['redirect'])) {
      header('Location: ' . $vnp_Url);
      die();
    } else {
      echo json_encode($returnData);
    }
    // vui lòng tham khảo thêm tại code demo
  }
}
