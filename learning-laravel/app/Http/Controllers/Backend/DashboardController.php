<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //gọi middleware ở đây
        //sử dụng cho toàn bộ class này
        //:admin là giá trị tham số của middleware
        //only chỉ tác động vào phương thức nào
        // $this->middleware('backend.login:admin')->only(['index','test']); 
        //user khác admin nên ko chạy đc quay lại trang login
    }

    public function index(Request $request)
    {
        // $sessionUser= $request->session()->get('adminUsername');
        // $age = 22;

        //CÁCH 1
        //truyền biến ra ngoài view
        // return view('backend.dashboard.index')
        //         ->with('user', $sessionUser)
        //         ->with('age', $age);
        
        // //CÁCH 2
        // return view('backend.dashboard.index',[
        //     'user'=> $sessionUser,
        //     'age'=>$age
        // ]);
        $product_count = Product::count();
        $brand_count=Brand::count();
        $category_count=Category::count();
        $user_count=User::count();
        $customer_count=Customer::count();
        $orders = Order::where('status',1)->get();
        $order_detail_count = OrderDetail::count();
        if(request()->date_form && request()->date_to){
            $orders = Order::where('status',1)->whereBetween('created_at',[request()->date_form, request()->date_to])->get();
        }
        return view('backend.dashboard.index',compact(
        'product_count',
        'brand_count',
        'category_count',
        'user_count',
        'customer_count',
        'orders',
        'order_detail_count'
        ));

    }
    
    public function test()
    {
        return "this is test dashboard";
    }

    public function demo()
    {
        //trong thự mục resource - trong thư mục view
        //tạo thư mục backend - tạo thư mục dashboard bên trong
        //tạo file có tên là demo.blade.php đây là template laravel
        return view('backend.dashboard.demo');
    }



}
