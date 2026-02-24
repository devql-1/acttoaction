<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //This method will show index page for Admin
    public function index(){
        return view('backend.index');
    }
}
