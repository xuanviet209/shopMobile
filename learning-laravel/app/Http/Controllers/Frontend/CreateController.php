<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function form() 
    {
        return view('frontend.create');
    }

    public function success(Request $request)
    {
    	Customer::create(
            [
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'password'=> bcrypt($request->password),
                'address' => $request->address
            ]);
    }
}
