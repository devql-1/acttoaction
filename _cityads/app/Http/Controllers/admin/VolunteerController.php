<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'phone'      => 'required',
        ]);

        Volunteer::create([

            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,

            'age'        => $request->age,
            'city'       => $request->city,
            'state'      => $request->state,
            'occupation' => $request->occupation,

            'roles'      => $request->role ? implode(',', $request->role) : null,

            'availability' => $request->availability,
            'hear_about'   => $request->hear_about,

            'motivation' => $request->motivation,
            'experience' => $request->experience,
        ]);

        return back()->with('success','Application submitted successfully!');
    }
}
