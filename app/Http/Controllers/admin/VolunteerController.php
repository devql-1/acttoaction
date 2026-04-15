<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::latest()->get();
        return view('backend.volunteers.index', compact('volunteers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'phone'      => ['required', 'string', 'max:15', function ($attr, $val, $fail) {
                if (!preg_match('/^\+91\d{10}$/', $val)) {
                    $fail('Phone must be a valid Indian 10-digit number (+91XXXXXXXXXX).');
                }
            }],
        ]);

        Volunteer::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'age'          => $request->age,
            'city'         => $request->city,
            'state'        => $request->state,
            'occupation'   => $request->occupation,
            'roles'        => $request->role ? implode(',', $request->role) : null,
            'availability' => $request->availability,
            'hear_about'   => $request->hear_about,
            'motivation'   => $request->message,   // form field is named "message"
            'experience'   => $request->experience,
        ]);

        return response()->json([
            'status'  => 200,
            'message' => 'Application submitted successfully!',
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,hired,rejected,cancelled',
        ]);

        $volunteer = Volunteer::findOrFail($id);
        $volunteer->update(['status' => $request->status]);

        return response()->json([
            'status'  => 200,
            'message' => 'Status updated to ' . ucfirst($request->status),
            'new_status' => $request->status,
        ]);
    }

    public function destroy($id)
    {
        Volunteer::findOrFail($id)->delete();
        return back()->with('success', 'Volunteer deleted successfully.');
    }
}
