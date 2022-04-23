<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostBrand;
use App\Http\Requests\UpdateBrand;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
  // const LIMIT_ITEM = 4; // 4 thuong hieu tren 1 trang
  public function index(Request $request)
  {
    $searchData["selectChoose"] = $request->choose_select;
    $searchData["key"] = $request->key ?? "";
    $dataBrands = Brand::getBrandDb($searchData);
    return view('backend.brand.index', [
      'brands' => $dataBrands
    ]);
  }

  public function edit(Request $request)
  {
    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    // lay chi tiet thuong hieu theo ID
    $infoBrand = DB::table('brands')->where('id', $id)->first();

    if ($infoBrand !== null) {
      // co du lieu theo id
      return view('backend.brand.edit', [
        'info' => $infoBrand
      ]);
    } else {
      // khong co du lieu
      return view('backend.not_found.brand');
    }
  }

  public function handleEdit(UpdateBrand $request)
  {
    // de cac ban tu lam validate =>đã làm => thay Request = UpdateBrand và nạp thư viện
    // logo anh : neu nguoi ko chon anh - giu anh cu
    $nameBrand = $request->input('nameBrand');
    $addBrand  = $request->input('addBrand');
    $descBrand = $request->input('descBrand');
    $status = $request->input('statusBrand');
    $status = $status === '1' ? $status : '0';

    $id = $request->id;
    $id = is_numeric($id) ? $id : 0;
    $infoBrand = DB::table('brands')->where('id', $id)->first();

    if ($infoBrand === null) {
      return redirect()->route('admin.brand.error');
    }

    $oldLogo = $infoBrand->logo;
    // upload anh
    if ($request->hasFile('logoBrand')) {
      if ($request->file('logoBrand')->isValid()) {
        // xoa anh cu
        File::delete('public/storage/images/' . $oldLogo);

        // tien hanh upload
        $oldLogo = $request->file('logoBrand')->getClientOriginalName();
        $dateCreate = date('Y-m-d H:i:s');
        $timeCreate = strtotime($dateCreate);
        $oldLogo = $timeCreate . '-' . $oldLogo;

        // anh day vao thu muc public
        $request->file('logoBrand')->move('storage/images', $oldLogo);
      }
    }

    // update
    $update = DB::table('brands')->where('id', $id)->update([
      'name' => $nameBrand,
      'address' => $addBrand,
      'description' => $descBrand,
      'logo' => $oldLogo,
      'status' => $status,
      'updated_at' => date('Y-m-d H:i:s')
    ]);

    if ($update) {
      return redirect()->route('admin.brand');
    } else {
      return redirect()->route('admin.brand.edit', ['slug' => Str::slug($infoBrand->name), 'id' => $id]);
    }
  }

  public function errorBrand()
  {
    return view('backend.not_found.brand');
  }

  public function add()
  {
    return view('backend.brand.add');
  }

  public function handleAdd(StorePostBrand $request)
  {
    $nameBrand = $request->input('nameBrand');
    $addBrand = $request->input('addBrand');
    $descBrand = $request->input('descBrand');

    // upload logo
    // check xem co upload ko ?
    // $nameLogo = null;
    $pathLogo = null;
    if ($request->hasFile('logoBrand')) {
      if ($request->file('logoBrand')->isValid()) {

        $pathLogo = $request->file('logoBrand')->getClientOriginalName();
        $dateCreate = date('Y-m-d H:i:s');
        $timeCreate = strtotime($dateCreate);
        $pathLogo = $timeCreate . '-' . $pathLogo;
        // tien hanh upload

        // anh day vao thu muc storage
        // $pathLogo = $request->file('logoBrand')->store('images');

        // anh day vao thu muc public
        $request->file('logoBrand')->move('storage/images', $pathLogo);
      }
    }

    if ($pathLogo !== null) {
      // insert database
      $insert = DB::table('brands')->insert([
        'name' => $nameBrand,
        'address' => $addBrand,
        'description' => $descBrand,
        'logo' => $pathLogo,
        'status' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null
      ]);
      if ($insert) {
        return redirect()->route('admin.brand');
      } else {
        return redirect()->route('admin.add.brand', ['state' => 'error']);
      }
    } else {
      return redirect()->route('admin.add.brand', ['state' => 'fail']);
    }
  }

  public function deleteBrand(Request $request)
  {
    if ($request->ajax()) {
      // check ajax
      $id = $request->id;
      $id = is_numeric($id) ? $id : 0;
      if ($id > 0) {
        $del = DB::table('brands')->where('id', $id)->delete();
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
