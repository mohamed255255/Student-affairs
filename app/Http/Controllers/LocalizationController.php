<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
   public function  setLang($local){
       App::setLocal($local);
       Session::put("local",$local);
       return redirect()->back();
   }
}
