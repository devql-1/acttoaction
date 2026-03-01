<?php

namespace App\Http\Controllers;

use App\Models\AdmissionShortForm;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use App\Models\AdmissionFullForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{

    // frontend function form 
    public function admission_short_form()
    {
        $classes = Service::where('status', 1)->get();
        return view('frontend.admission-short-form', compact('classes'));
    }

    public function admission_short_form_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admission_class' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'state' => 'required|string',
            'city' => 'required|string',
            'mobile' => 'required|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Save in DB
        AdmissionShortForm::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Admission form submitted successfully!'
        ]);
    }


    // backend function for listing 
    public function admission_short_form_listing()
    {
        $admission_enquiry = AdmissionShortForm::latest()->get();
        return view('backend.enquiries.admission.short-form', compact('admission_enquiry'));
    }

    // backend destroy admission short form 
    public function admission_short_form_destroy($id)
    {
        AdmissionShortForm::find($id)->delete();
        return response()->json(['success' => true]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school' => 'required|string|max:255',
            'fee' => 'nullable|numeric',
            'classname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'father_occupation' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mother_occupation' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'category' => 'required|string|max:50',
            'caste' => 'required|string|max:50',
            'religion' => 'required|string|max:100',
            'aadhar_card' => 'required|digits:12',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'dob_year' => 'required|date',
            'place_birth' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'pin_code' => 'required|digits:6',
            'residential' => 'nullable|string|max:10',
            'physically' => 'nullable|string|max:10',
            'name_previous_school' => 'nullable|string|max:255',
            'medium_previous_school' => 'nullable|string|max:50',
            'income_parents' => 'nullable|string|max:100',
            'name_sibling' => 'nullable|string|max:255',
            'class_sibling' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $contact = AdmissionFullForm::create($request->all());

        // Send mail to admin (use config('mail.from.address') or set admin email)
        $adminEmail = config('mail.from.address') ?? 'admin@yourdomain.com';
        // For production prefer ->queue(...) if queue configured
        Mail::to($adminEmail)->send(new ContactAdminMail($contact));

        // Optional: send confirmation to user if provided
        if (!empty($contact->email)) {
            Mail::to($contact->email)->send(new ContactUserMail($contact));
        }

        return response()->json([
            'status' => true,
            'message' => 'Thank you! We will contact you soon.'
        ]);
    }


}
