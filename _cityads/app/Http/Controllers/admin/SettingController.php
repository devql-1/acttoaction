<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('auth.backend.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'website_name',
            'site_motto',
            'site_logo',
            'system_logo_white',
            'system_logo_black',
            'login_page_image',
            'login_bg_image',
        ];
    
        foreach ($fields as $field) {
            // === Remove image handle (x-file-upload ke cross button se) ===
            if ($request->input('remove_' . $field) == "1") {
                $old = Setting::where('key', $field)->first();
            
                if ($old && $old->value && file_exists(public_path($old->value))) {
                    unlink(public_path($old->value));
                }
            
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => null]
                );
            
                continue; // agle field pe chale jao
            }
        
            // === Upload new image handle ===
            if ($request->hasFile($field)) {
                $old = Setting::where('key', $field)->first();
            
                if ($old && $old->value && file_exists(public_path($old->value))) {
                    unlink(public_path($old->value));
                }
            
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/'), $filename);
            
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' =>  $filename]
                );
            
            } elseif ($request->filled($field)) {
                // === Normal text fields handle ===
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $request->$field]
                );
            }
        }
    
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }


}

