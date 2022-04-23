<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\DB; // su dung database

class LoginController extends Controller
{
  public function index()
  {
    // $data = DB::table('admins')->get();
    //std class : là object ko phải mảng
    //select * form admins
    // dd($data);
    // foreach($data as $key =>$item){
    //     echo $item->id;
    // }
    // die;
    return view('backend.login.index');
  }
  //Request
  public function handleLogin(LoginPostRequest $request)
  {
    //Request $request: nhận toàn bộ request dữ liệu gửi lên
    // $data = $request->all();
    $username = $request->input('email');
    $password = $request->input('password');
    //dd($username, $password); //var_dump()+die(): hiện thị toàn dữ liệu

    $dataAdminLogin = DB::table('admins')
      ->where([
        'email' => $username,
        'password' => $password,
        'status' => 1
      ])
      //    ->where('username','=',$username) // >=
      //    ->where('password', $password)
      //    ->where('status',1)
      ->first(); //lấy ra 1 dòng dữ liệu
    // ->get(); //lấy tất cả dữ liệu

    // dd($dataAdminLogin);

    //kiểm tra tài khoản account có tồn tại ko?
    //liên quan đến database
    if (
      isset($dataAdminLogin->id)
      && isset($dataAdminLogin->username)
      && !empty($dataAdminLogin->username)
    ) {
      //login thành công

      //lưu thông tin người dùng vào session
      $request->session()->put('adminUsername', $dataAdminLogin->username);
      $request->session()->put('idAdmin', $dataAdminLogin->id);
      $request->session()->put('emailAdmin', $dataAdminLogin->email);
      $request->session()->put('roleAdmin', $dataAdminLogin->role);
      //$_SESSION['adminUsername'] = $username;

      //đi vào trang quản trị admin(dashboard)
      return redirect()->route('admin.dashboard');
    } else {
      //login ko thành công :tk ko tồn tại
      //with : tạo session flash ==> nhận thông báo
      return redirect()->route('admin.login')->with('statusLogin', 'Account invalid');
    }
  }

  public function logout(Request $request)
  {
    //xóa session  từng session
    //$request->session()->forget('adminUsername);

    //xóa toàn bộ session
    $request->session()->flush();

    //quay về trang log in
    return redirect()->route('admin.login');
  }
}
