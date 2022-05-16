<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DetailController;

/*
|--------------------------------------------------------------------------
| Backend Routes for admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
  ->as('admin.')
  ->middleware('backend.admin.login')
  ->group(function(){
    // account
    Route::get('account',[AccountController::class, 'index'])->name('account');
    
    //backend/dashboard
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

    
    // brand
    Route::get('brand',[BrandController::class, 'index'])->name('brand');
    Route::get('insert-brand',[BrandController::class, 'add'])->name('add.brand');
    Route::post('handle-insert-brand',[BrandController::class, 'handleAdd'])->name('handle.add.brand');
    Route::post('delete-brand',[BrandController::class,'deleteBrand'])->name('delete.brand');
    Route::get('brand/{slug}/{id}',[BrandController::class, 'edit'])->name('brand.edit');
    Route::get('brand/not-found',[BrandController::class, 'errorBrand'])->name('brand.error');
    Route::post('edit/brand/{id}',[BrandController::class, 'handleEdit'])->name('handle.edit.brand');

    //category
    Route::get('category',[CategoryController::class, 'index'])->name('category');
    //add category
    Route::get('insert-category',[CategoryController::class, 'add'])->name('add.category');
    Route::post('handle-insert-category',[CategoryController::class, 'handleCategory'])->name('handle.add.category');
    //edit category
    Route::get('category/{slug}/{id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::get('category/not-found',[CategoryController::class, 'errorCategory'])->name('category.error');
    Route::post('edit/category/{id}',[CategoryController::class, 'handleEdit'])->name('handle.edit.category');
    //xóa category
    Route::post('delete-category',[CategoryController::class, 'deleteCategory'])->name('delete.category');

    //products
    Route::get('product',[ProductController::class, 'index'])->name('product');
    //add products
    Route::get('insert-product',[ProductController::class, 'add'])->name('add.product');
    Route::post('handle-insert-product',[ProductController::class, 'handleAddProduct'])->name('handle.add.product');
    //edit products
    Route::get('product/{slug}/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::get('product/not-found',[ProductController::class, 'errorProduct'])->name('product.error');
    Route::post('edit/product/{id}',[ProductController::class, 'handleEdit'])->name('handle.edit.product');
    //delete products
    Route::post('delete-product',[ProductController::class, 'deleteProduct'])->name('delete.product');

    //user
    Route::get('user',[UserController::class,'index'])->name('user');
    Route::get('add_account',[UserController::class,'create'])->name('add_account');
    
    //Order
    Route::get('order',[OrderController::class,'index'])->name('order');
    
    //Customer
    Route::get('customer',[CustomerController::class,'index'])->name('customer');
    
    //Coupon
    Route::get('coupon',[CouponController::class,'index'])->name('coupon');
    Route::get('insert-coupon',[CouponController::class,'add'])->name('add.coupon');
    Route::post('handle-insert-coupon',[CouponController::class, 'handleAddCoupon'])->name('handle.add.coupon');
    Route::post('delete-coupon',[CouponController::class, 'deleteCoupon'])->name('delete.coupon');
    Route::get('send-coupon/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}',[CouponController::class,'sendCoupon']);

    //Order_detail
    Route::get('order_detail',[DetailController::class,'index'])->name('detail');
    // Route::get('print_order/{checkout_code}',[DetailController::class,'printOrder']);
});

Route::prefix('admin')->as('admin.')->group(function () {
  // backend/login
  Route::get('login',[LoginController::class, 'index'])
    ->middleware('if.backend.admin.login')
    ->name('login');
  // handle login
  Route::post('handle-login', [LoginController::class, 'handleLogin'])->name('handle.login');
  // backend/logout
  Route::post('logout',[LoginController::class, 'logout'])->name('handle.logout');
});

