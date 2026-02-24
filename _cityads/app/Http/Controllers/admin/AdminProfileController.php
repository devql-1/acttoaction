<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function profile(){
        $profile = Auth::guard('admin')->user();
        return view('auth.backend.profile.profile',compact('profile'));
    }

    public function profile_update(Request $request)
    {
        $admin = Auth::guard('admin')->user();
    
        // ✅ Validation rules
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    
        // Agar password fields fill hain to password rules add karo
        if ($request->filled('old_password') || $request->filled('new_password') || $request->filled('new_password_confirmation')) {
            $rules['old_password'] = 'required';
            $rules['new_password'] = 'required|min:6|confirmed'; // Laravel auto check karega `new_password_confirmation`
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // ✅ Update name & email
        $admin->name  = $request->name;
        $admin->email = $request->email;
    
        // ✅ Image Update
        if ($request->hasFile('image')) {
            if ($admin->image && file_exists(public_path('img/'.$admin->image))) {
                unlink(public_path('img/'.$admin->image));
            }
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $admin->image = $filename;
        }
    
        // ✅ Password Update
        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $admin->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput();
            }
            $admin->password = Hash::make($request->new_password);
        }
    
        $admin->save();
    
        return redirect()->back()->with('success', 'Admin Profile updated successfully!');
    }

}
