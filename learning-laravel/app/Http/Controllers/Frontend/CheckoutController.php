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
        $cart = \Cart::content()->toArray(); // lấy ra giỏ hàng
        $customer_id = Auth::guard('cus')->user()->id;
        $customerEmail= Auth::guard('cus')->user()->email;
        $customerName= Auth::guard('cus')->user()->name;
        if ($order = Order::create([
            'customer_id' => $customer_id,
            'orders_note' => $request->orders_note,
            'customerName'=> $customerName,
        ])) {
            $orders_id = $order->id;
            foreach ($cart as $products_id => $item ) { 
                $products_id = $item['id']; //lấy ra id
                $quantity = $item['qty']?? '';
                $price = $item['price']*$item['qty'] ?? '';
                OrderDetail::create([
                    'orders_id'=> $orders_id,
                    'products_id'=>$products_id,
                    'price'=>$price,
                    'quantity'=>$quantity
                ]);
            }
            Mail::send('frontend.email.order', [
              'order' => $order,
              'cart' => $cart,
              'name' => $customerName
            ], function ($mail) use ($customerEmail,$customerName)
            {
              $mail->from('vietd8k11@gmail.com');
              $mail->to($customerEmail,$customerName);
              $mail->subject('Email Orders');
            });
            session(['cart' => '']);
            return redirect()->route('fr.checkout.success')->with('success');
        }else{
            return redirect()->back()->with('error','Đặt hàng không thành công');
        }
    }
    
    public function checkCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' =>$coupon->coupon_code,
                            'coupon_condition'=>$coupon->coupon_condition,
                            'coupon_number' =>$coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else {
                    $cou[] = array(
                        'coupon_code' =>$coupon->coupon_code,
                        'coupon_condition'=>$coupon->coupon_condition,
                        'coupon_number' =>$coupon->coupon_number,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }
        }else {
            return redirect()->back()->with('message','Thêm mã giảm giá không thành công');
        }
    }
}
