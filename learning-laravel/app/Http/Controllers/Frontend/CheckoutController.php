<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
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
              'order' => $order->id,
              'cart' => $cart,
              'name' => $customerName
            ], function ($mail) use ($customerName,$customerEmail)
             {
                  $mail->to($customerName,$customerEmail);
                  $mail->from('vietd8k11@gmail.com');
                  $mail->subject('Email Orders');
            });
            session(['cart' => '']);
            return redirect()->route('fr.checkout.success')->with('success');
        }else{
            return redirect()->back()->with('error','Đặt hàng không thành công');
        }
    }
}
