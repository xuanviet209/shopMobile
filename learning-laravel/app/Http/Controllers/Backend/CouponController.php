<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Mail;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::get();
        return view('backend.coupon.index', [
            'coupon' => $coupons
        ]);
    }

    public function add()
    {
        return view('backend.coupon.add');
    }

    public function handleAddCoupon(Request $request)
    {
        $couponName = $request->input('coupon_name');
        $couponTime = $request->input('coupon_time');
        $couponCondition = $request->input('coupon_condition');
        $couponNumber = $request->input('coupon_number');
        $couponCode = $request->input('coupon_code');

        $insertCoupon = DB::table('coupon')->insert([
            'coupon_name' => $couponName,
            'coupon_time' => $couponTime,
            'coupon_condition' => $couponCondition,
            'coupon_number' => $couponNumber,
            'coupon_code' => $couponCode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);
        if ($insertCoupon) {
            return redirect()->route('admin.coupon');
        } else {
            return redirect()->route('admin.add.coupon', ['state' => 'error']);
        }
    }
    
    public function sendCoupon($coupon_time,$coupon_condition,$coupon_number,$coupon_code)
    {
      // $customer_vip = Customer::where('customer_vip',1)->get();
      $customer = Customer::get();
      $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
      $coupon = Coupon::where('coupon_code',$coupon_code)->first();
      $title_mail = "Mã khuyến mãi ngày".' '.$now;
      $data = [];
      foreach($customer as $cus){
        $data['email'][] = $cus->email;
      }
      
      $coupon = array(
        'coupon_time' => $coupon_time,
        'coupon_condition'=>$coupon_condition,
        'coupon_number' =>$coupon_number,
        'coupon_code' => $coupon_code
      );
      
      Mail::send('backend.email.coupon', ['coupon' =>$coupon], function($message) use ($title_mail,$data)
      {
        $message->to($data['email'])->subject($title_mail);
        $message->from('vietd8k11@gmail.com');
      });
      return redirect()->back()->with('message', 'Gửi mã giảm giá thành công');
    }

    public function deleteCoupon(Request $request)
    {
      if ($request->ajax()) {
        // check ajax
        $coupon_id = $request->coupon_id;
        $id = is_numeric($coupon_id) ? $coupon_id : 0;
        if ($coupon_id > 0) {
          $del = DB::table('coupon')->where('coupon_id', $coupon_id)->delete();
          if ($del) {
            return response()->json([
              'cod' => 200,
              'mess' => 'delete success'
            ]);
          } else {
            return response()->json([
              'cod' => 500,
              'mess' => 'Error delete'
            ]);
          }
        } else {
          return response()->json([
            'cod' => 404,
            'mess' => 'Error param id'
          ]);
        }
      }
    }
}
