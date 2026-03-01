<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // This method show login form for customer or general user
    public function index(){
        return view('auth.frontend.login');
    }

    // This method will authenticate user
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                if(Auth::user()->role != 'customer'){
                    Auth::logout();
                    return redirect()->route('account.login')->with('error','You are not authorized to access this page');
                }

                return redirect()->route('account.dashboard');

            }else{
                return redirect()->route('account.login')->with('success','Either email or password is incorrect');
            }

        }else{
            return redirect()->route('account.login')->withErrors($validator)->withInput();
        }

    }

    // This method will show register page for user
    public function register(){
        return view('auth.frontend.register');
    }

    public function process_register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required'
        ]);

        if($validator->passes()){
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();

            return redirect()->route('account.login')->with('success','You have successfully Registered');
            
        }else{
            return redirect()->route('account.register')->withErrors($validator)->withInput();
        } 

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
}
