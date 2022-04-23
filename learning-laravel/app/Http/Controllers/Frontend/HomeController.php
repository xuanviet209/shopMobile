<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController as Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index(Request $request) //Category $category
  {
    $searchProduct["key"] = $request->key ??  "";
    // if($searchProduct != "")
    // {
    //     $dataProduct->where('name','like','%'.$searchProduct["key"].'%');
    // }
    if (isset($_GET['sort_by'])) {
      $sort_by = $_GET['sort_by'];

      if ($sort_by == 'giam_dan') {

        $product_by_id = Product::where('name', 'like', '%' . $searchProduct["key"] . '%')->orderBy('price', 'DESC')->paginate(config("constant.paginate"))->appends($searchProduct);
      } elseif ($sort_by == 'tang_dan') {

        $product_by_id = Product::where('name', 'like', '%' . $searchProduct["key"] . '%')->orderBy('price', 'ASC')->paginate(config("constant.paginate"))->appends($searchProduct);
      } elseif ($sort_by == 'kytu_za') {

        $product_by_id = Product::where('name', 'like', '%' . $searchProduct["key"] . '%')->orderBy('name', 'DESC')->paginate(config("constant.paginate"))->appends($searchProduct);
      } elseif ($sort_by == 'kytu_az') {

        $product_by_id = Product::where('name', 'like', '%' . $searchProduct["key"] . '%')->orderBy('name', 'ASC')->paginate(config("constant.paginate"))->appends($searchProduct);
      }
    } else {
      $product_by_id = Product::where('name', 'like', '%' . $searchProduct["key"] . '%')->orderBy('id', 'DESC')->paginate(config("constant.paginate"))->appends($searchProduct);
    }

    // $product_by_id=Product::getProducts($searchProduct);
    return view('frontend.home.index', [
      'products' => $product_by_id
    ]);
  }

  public function logout()
  {
    Auth::guard('cus')->logout();
    return redirect()->route('fr.home');
  }

  public function login()
  {
    return view('frontend.home.login');
  }

  public function postLogin(Request $request)
  {
    $this->validate($request, [
      'email' => 'required',
      'password' => 'required',
    ], [
      'email.required' => ' Vui lòng nhập địa chỉ Email xv',
      'password.required' => 'Vui lòng nhập Password',
    ]);

    if (Auth::guard('cus')->attempt($request->only('email', 'password'), $request->has('remember'))) {
      return redirect()->route('fr.home');
    } else {
      return redirect()->back();
    }
  }
  //lọc theo danh mục
  public function view($id)
  {
    $category = Category::where('id', $id)->first();
    $dataProduct = DB::table('products');
    return view('frontend.home.product', [
      'category' => $category,
      'products' => $dataProduct
    ]);
  }

  public function contact()
  {
    return view('frontend.contact');
  }

  public function postContact(Request $request)
  {
    Mail::send('frontend.email.send', [
      'name' => $request->name,
      'email' => $request->email,
      'content' => $request->content,
      'phone' => $request->phone,
    ], function ($mail) use ($request) {
      $mail->to('vietd8k11@gmail.com');
      $mail->from($request->email);
      $mail->subject('Thông tin liên hệ');
    });
  }

  public function detailProduct(Request $request)
  {
    $products = Product::where('slug', $request->slug)->first();
    // $category = Category::where('status',1)->get();
    return view('frontend.detail.index', [
      'products' => $products
      // 'category'=> $category
    ]);
  }
}
