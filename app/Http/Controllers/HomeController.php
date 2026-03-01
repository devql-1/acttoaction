<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('frontend.Home.index');
    }
    public function course()
    {
        return view('frontend.course.course');
    }
}
