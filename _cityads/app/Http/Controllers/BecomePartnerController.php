<?php

namespace App\Http\Controllers;

use App\Models\BecomePartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BecomePartnerController extends Controller
{
    public function index(){
        return view('frontend.become-partner');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'fullname' => 'required|string|max:100',
        'email' => 'required|email|unique:become_partners,email', // 👈 fix table name
        'phone' => 'required|digits_between:10,15',
        'website' => 'nullable|url',
        'designation' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'city' => 'required|string|max:100',
        'agree' => 'accepted',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    BecomePartner::create($validator->validated());

    return response()->json([
        'status' => 'success',
        'message' => 'Thank you! Your form has been submitted successfully.'
    ]);
}



}
