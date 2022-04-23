<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostCategory;
use App\Http\Requests\UpdateCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
  public function index(Request $request)
  {
    $searchCategories["key"] = $request->key ?? "";
    $categories = Category::getCategoryDb($searchCategories);    //->paginate(config("constant.paginate")); //->get();
    return view('backend.category.index', [
      'categories' => $categories
    ]);
  }

  public function edit(Request $request)
  {
    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    $infoCategory = DB::table('categories')->where('id', $id)->first();
    if ($infoCategory != null) {
      return view('backend.category.edit', [
        'info' => $infoCategory
      ]);
    } else {
      return view('backend.not_found.category');
    }
  }
  public function handleEdit(UpdateCategory $request)
  {
    $nameCategory = $request->input('nameCategory');
    $parentId = $request->input('parentIdCategory');
    $descCategory = $request->input('descCategory');
    $status = $request->input('statusCategory');
    $status = $status === '1' ? $status : '0';

    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    $infoCategory = DB::table('categories')->where('id', $id)->first();

    if ($infoCategory === null) {
      return redirect()->route('admin.category.error');
    }

    $updateCategory = DB::table('categories')->where('id', $id)->update([
      'name' => $nameCategory,
      'parentId' => $parentId,
      'description' => $descCategory,
      'status' => $status,
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    if ($updateCategory) {
      return redirect()->route('admin.category');
    } else {
      return redirect()->route('admin.brand.edit', ['slug' => Str::slug($infoCategory->name), 'id' => $id]);
    }
  }

  public function errorCategory()
  {
    return view('backend.not_found.category');
  }

  public function add()
  {
    return view('backend.category.add');
  }
  //add
  public function handleCategory(StorePostCategory $request)
  {
    $nameCategory = $request->input('nameCategory');
    $parentId = $request->input('parentIdCategory');
    $descCategory = $request->input('descCategory');

    $insertCategory = DB::table('categories')->insert([
      'name' => $nameCategory,
      'parentId' => $parentId,
      'description' => $descCategory,
      'status' => 1,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => null
    ]);
    if ($insertCategory) {
      return redirect()->route('admin.category');
    } else {
      return redirect()->route('admin.add.category', ['state' => 'error']);
    }
  }
  //delete
  public function deleteCategory(Request $request)
  {
    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    if ($id > 0) {
      $delCategory = DB::table('categories')->where('id', $id)->delete();
      return view('backend.category.index', [
        'categories' => $delCategory
      ]);
    } else {
    }
  }
}
