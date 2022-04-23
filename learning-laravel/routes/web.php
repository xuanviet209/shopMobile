<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// get : method truy cap la get ($_GET)
// /hello-word : routing (dieu huong - truy cap)
// function: xy ly cho yeu cua routing (/hello-word)
Route::get('/hello-word', function () {
    return 'Hello-word';
});

Route::post('/insert-user', function () {
    return 'demo method post routing';
});

Route::delete('users/{id}', function ($id) {
    // {id} : tham so bat buoc cua routing
    // $id : bien de lay gia tri tu url routing
    return " id {$id} of user deleted";
});

Route::get('product/{name?}/{id?}', function($name = null, $id = null){
    // {name?} : tham so khong bat buoc
    return 'san pham ' . $name . ' co id = ' . $id . 'da dc ban';
});

// kiem tra tham so truyen vao routing
Route::get('profile-user/{id}', function ($id) {
    return "user co id = " . $id;
})->where('id','\d+');

Route::get('list-users/{name}/{id}', function ($id) {
    return "user co id = " . $id;
})->where(['name'=>'[A-Za-z]+','id'=>'[0-9]+']);


// dat ten cho routing - sau nay mh chi can goi qua ten cua no
Route::get('/brand/add',function(){
    return 'Add brand';
})->name('add.brand');

Route::get('api/v1/list-all-users/{token}', function ($token) {
    return "dc phep xem thong tin user";
})->middleware('verified.test.token');

Route::get('watch-film/{age}', function($age) {
    return "Ban da {$age} tuoi - duoc xem phim";
})->middleware('check.age.user');

Route::get('do-not-watch-film', function(){
    return 'Ban chua dc phep xem may bo phim do';
})->name('not.view.film');