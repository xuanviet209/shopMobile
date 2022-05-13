<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CreateController;

/*
|--------------------------------------------------------------------------
| Frontend Routes for users
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about',[AboutController::class,'index'])->name('about');

//cart
Route::get('cart',[CartController::class,'index'])->name('cart');
Route::get('add-to-cart/{id}',[CartController::class,'addCart'])->name('add.cart');
Route::get('remove-item-cart/{id}',[CartController::class,'removeCart'])->name('remove.cart');
Route::post('update-cart',[CartController::class,'updateCart'])->name('update.cart');

//home
Route::get('category/{id}',[HomeController::class,'view'])->name('view');

Route::get('contact',[HomeController::class,'contact'])->name('contact');
Route::post('contact',[HomeController::class,'postContact'])->name('contact');

Route::get('detail',[HomeController::class,'detailProduct'])->name('detail');

Route::get('home_logout',[HomeController::class,'logout'])->name('home.logout');
Route::get('home_login',[HomeController::class,'login'])->name('home.login');
Route::post('home_login',[HomeController::class,'postLogin'])->name('home.login');

//checkout
Route::get('checkout',[CheckoutController::class,'form'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'submitForm'])->name('checkout');
Route::get('checkout/success',[CheckoutController::class,'success'])->name('checkout.success');
Route::post('/check-coupon',[CheckoutController::class,'checkCoupon']);
Route::post('/vnpay_payment',[CheckoutController::class,'vnpay_payment']);
//Đăng ký
Route::get('create',[CreateController::class,'form'])->name('create');
Route::post('create',[CreateController::class,'success'])->name('create');

