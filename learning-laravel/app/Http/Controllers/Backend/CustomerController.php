<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {   
      $listCustomers = Customer::get();
        return view('backend.customer.index',[
          'customer' => $listCustomers
      ]);
    }
}
