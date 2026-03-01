<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    //This method will show login form for admin
    public function index(){
        // return view('auth.backend.login');
        return view('auth.backend.login');
    }

    // This method will authenticate admin
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){
            
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

                if(Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You are not authorized to access this page');
                }

                return redirect()->route('admin');

            }else{
                return redirect()->route('admin.login')->with('success','These credentials do not match our records.');
            }

        }else{
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }

    }

    // This method will logout admin
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
