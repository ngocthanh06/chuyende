<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
class HomeController extends Controller
{
    //
    public function index(){
        return view ('welcome');
    }
    public function getIp(Request $request){
        return $request->ip();
    }
}
