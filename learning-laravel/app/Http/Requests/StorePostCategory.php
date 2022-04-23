<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nameCategory' =>'required|min:3|max:60|unique:brands,name',
            'parentIdCategory'=>'required',
            'descCategory' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'nameCategory.required' => ':attribute không được để trống',
            'nameCategory.unique' => ':attribute da ton tai, chon ten khac',
            'nameCategory.min' => ':attribute khong nho hon :min ky tu',
            'nameCategory.max' => ':attribute khong lon hon :max ky tu',
            'parentIdCategory.required' => ':attribute không được để trống',
            'descCategory.required' => ':attribute không được để trống'
        ];
    }
}
