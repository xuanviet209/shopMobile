<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\View;


class FrontendController extends Controller
{
    public function __construct()
    {
       $categories = $this->getDataCategory();
    //    $countCartItem=\Cart::count();
       //share data categories cho mọi view dùng được
       View::share('categories',$categories);
       //đếm số lượng trong giỏ hàng
    //    View::share('countCart',$countCartItem);
    }

    protected function getDataCategory()
    {
        return Category::all();
    }
}
