<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController as Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function index(Request $request)
  {
    return view('frontend.about.index');
  }
}