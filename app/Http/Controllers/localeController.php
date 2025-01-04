<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class 
localeController extends Controller
{
    public function setLocale($lang){
        if(in_array($lang, ['en', 'ur', 'ar'])){

            App::setLocale($lang);
            Session::put('locale', $lang);
        }

        return back();
    }
}
