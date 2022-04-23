<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController as Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;

class CartController extends Controller
{
  public function __construct()
  {
    $this->middleware('cus');
  }
  public function index(Request $request)
  {
    //láy toàn bộ thông tin sản phẩm trong giỏ hàng
    $cart = \Cart::content();
    //   
    return view('frontend.cart.index', [
      'cart' => $cart
    ]);
  }

  public function removeCart(Request $request)
  {
    $idCart = $request->id;
    if ($idCart !== null && $idCart !== '') {
      //xóa
      \Cart::remove($idCart);
      return redirect()->route('fr.cart', ['state' => 'success']);
    }
    return redirect()->route('fr.cart', ['state' => 'fail']);
  }

  public function updateCart(Request $request)
  {
    $qty = $request->input('qtyCart');
    $qty = is_numeric($qty) && $qty > 0 && $qty <= 5 ? $qty : 1;
    $rowId = $request->input('rowIdItem');
    if ($rowId !== null && $rowId !== '') {
      $up = \Cart::update($rowId, $qty);
      if ($up) {
        return redirect()->route('fr.cart', ['state' => 'success']);
      } else {
        return redirect()->route('fr.cart', ['state' => 'error']);
      }
    }
    return redirect()->route('fr.cart', ['state' => 'fail']);
  }

  public function addCart(Request $request)
  {
    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    //$info = Product::findOrFail($id);
    $info = Product::find($id);
    if ($info !== null) {
      \Cart::add([
        'id' => $id,
        'name' => $info->name,
        'qty' => 1,
        'price' => $info->price,
        'weight' => 1,
        'options' => [
          'image' => $info->image,
          'description' => $info->description
        ]
      ]);
      // quay về trang xem thông tin giỏ hàng
      return redirect()->route('fr.cart');
    } else {
      return redirect()->route('fr.home')->withErrors('Can not to cart');
    }
  }
}
