<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Coupon;

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
