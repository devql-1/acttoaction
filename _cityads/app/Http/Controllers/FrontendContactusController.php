<?php

namespace App\Http\Controllers;

use App\Models\FrontendContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontendContactusController extends Controller
{
    // frontend contactus page 
    public function contact(){
        return view('frontend.contact');
    }

    public function contactus_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'nullable|string',
            'subject' => 'required|string',
            'mobile' => 'required|digits:10',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        // Save in DB
        FrontendContactUs::create($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Contact Us Enquiry submitted successfully!'
        ]);
    }

    // backend listing frontend contactus page
    public function contactus_enquiry(){
        $contactus_enquiry = FrontendContactUs::latest()->get();
        return view('backend.enquiries.contactus.index',compact('contactus_enquiry'));
    }

    // backend destroy contactus
    public function contactus_destroy($id){
        FrontendContactUs::find($id)->delete();
        return response()->json(['success' => true]);
    }
}
