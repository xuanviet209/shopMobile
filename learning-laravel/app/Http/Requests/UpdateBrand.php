<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrand extends FormRequest
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
            'nameBrand' => 'required|min:3|max:60',
            'addBrand' => 'required',
            'descBrand' => 'required',
            'logoBrand' => 'required|image|dimensions:min_width=100,min_height=200'
        ];
    }

    public function messages()
    {
        return [
            'nameBrand.required' => ':attribute khong duoc de trong',
            'nameBrand.min' => ':attribute khong nho hon :min ky tu',
            'nameBrand.max' => ':attribute khong lon hon :max ky tu',
            'addBrand.required' => ':attribute khong dc de trong',
            'descBrand.required' => ':attribute khong dc de trong',
            'logoBrand.image' => ':attribute la dinh dang jpg, jpeg, png, bmp, gif, svg, or webp',
            'logoBrand:dimensions' => ':attribute co kich thuoc toi thieu la :min_width x :min_height' ,
            'logoBrand.required' => ':attribute khong dc trong'
        ];
    }
}
