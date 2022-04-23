<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //true: hỗ trợ validate
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //định nghĩa các luật để kiểm tra tính hợp lệ dữ liệu
            'email'=> 'required|email',
            'password'=>'required|min:6|max:60'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //hiển thị thông báo 
    public function message()
    {
        return [
             'email.required' =>'ko dc trong',
             'email.email' => 'vui lòng nhập đúng định dạng email',
             'password.required'=>'ko dc để trống',
             'password.min' => 'Mật khẩu phải ít nhất :min ky tụ trở lên',
             'password.max' => 'Mật khẩu ko nhiều hơn :max ký tự'
        ];
    }
}
