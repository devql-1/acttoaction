<?php

namespace App\Http\Controllers;

use App\Models\FranchiseForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FranchiseController extends Controller
{
    // frontend page function 
    public function index(){
        return view('frontend.franchise');
    }

    public function franchise_form_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email',
            'state' => 'required|string',
            'city' => 'required|string',
            'mobile' => 'required|digits:10',
            'query' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Save in DB
        FranchiseForm::create($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Franchise form submitted successfully!'
        ]);
    }

    // backend listing function
    public function franchise_listing(){
        $franchise_enquiry = FranchiseForm::latest()->get();
        return view('backend.enquiries.franchise.index',compact('franchise_enquiry'));
    }

    // backend destroy franchise form 
    public function franchise_destroy($id){
        FranchiseForm::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
