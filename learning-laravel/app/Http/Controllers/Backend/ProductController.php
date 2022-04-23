<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
  public function index()
  {
    $product = DB::table('products')->paginate(config("constant.paginate"));
    return view('backend.product.index', [
      'products' => $product
    ]);
  }

  public function add(Request $request)
  {
    $categories = Category::all();
    $brands = Brand::all();
    return view('backend.product.add', compact('categories', 'brands'));
  }

  public function handleAddProduct(Request $request)
  {
    $nameProduct = $request->input('nameProduct');
    $slugProduct = $request->input('slugProduct');
    $categoryProduct = $request->input('categoryProduct');
    $brandProduct = $request->input('brandProduct');
    $descProduct = $request->input('descProduct');
    $priceProduct = $request->input('priceProduct');
    $quantityProduct = $request->input('quantityProduct');

    $pathImage = null;
    if ($request->hasFile('imageProduct')) {
      if ($request->file('imageProduct')->isValid()) {

        $pathImage = $request->file('imageProduct')->getClientOriginalName();
        $dateCreate = date('Y-m-d H:i:s');
        $timeCreate = strtotime($dateCreate);
        $pathImage = $timeCreate . '-' . $pathImage;
        // tien hanh upload

        // anh day vao thu muc storage
        // $pathLogo = $request->file('logoBrand')->store('images');

        // anh day vao thu muc public
        $request->file('imageProduct')->move('storage/images', $pathImage);
      }
    }
    if ($pathImage !== null) {
      // insert database
      $insert = DB::table('products')->insert([
        'name' => $nameProduct,
        'slug' => $slugProduct,
        'categories_id' => $categoryProduct,
        'brands_id' => $brandProduct,
        'description' => $descProduct,
        'image' => $pathImage,
        'price' => $priceProduct,
        'quantity' => $quantityProduct,
        'status' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null
      ]);
      if ($insert) {
        return redirect()->route('admin.product');
      } else {
        return redirect()->route('admin.add.product', ['state' => 'error']);
      }
    } else {
      return redirect()->route('admin.add.product', ['state' => 'fail']);
    }
  }
  public function edit(Request $request)
  {
    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    $categories = Category::all();
    $brands = Brand::all();
    $infoProducts = DB::table('products')->where('id', $id)->first();
    if ($infoProducts !== null) {
      // co du lieu theo id
      return view('backend.product.edit', [
        'infoProduct' => $infoProducts, compact('brands', 'categories')
      ]);
    } else {
      // khong co du lieu
      return view('backend.not_found.product');
    }
  }
  public function handleEdit()
  {
    
  }

  public function deleteProduct(Request $request)
  {
    if ($request->ajax()) {
      $id = $request->id;
      $id = is_numeric($id) ? $id : 0;
      if ($id > 0) {
        $del = DB::table('products')->where('id', $id)->delete();
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
