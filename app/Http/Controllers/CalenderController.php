<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function index(){
        return view('calender_main');
    }
    public function calender(){
        return view('calender');
    }
}
