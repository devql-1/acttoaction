<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IconController extends Controller
{
    public function add(Request $request)
    {
        $icon = $request->input('icon');
        $path = public_path('icons.json');
    
        $icons = [];
        if (file_exists($path)) {
            $icons = json_decode(file_get_contents($path), true);
        }
    
        // Already exists
        if (in_array($icon, $icons)) {
            return response()->json([
                'success' => false,
                'message' => 'Icon already exists!',
                'icons'   => array_values(array_unique($icons)) // return cleaned
            ]);
        }
    
        // Add new icon
        $icons[] = $icon;
        $icons = array_values(array_unique($icons)); // ensure no duplicates
        file_put_contents($path, json_encode($icons, JSON_PRETTY_PRINT));
    
        return response()->json([
            'success' => true,
            'icon'    => $icon,
            'icons'   => $icons
        ]);
    }

}

