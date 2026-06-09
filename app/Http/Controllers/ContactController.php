<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'mobile'   => 'required|string|max:30',
            'subject'  => 'required|string|max:255',
            'message'  => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Save into DB
        $contact = Contact::create([
            'username' => $request->name,
            'phone'    => $request->mobile,
            'message'  => $request->message,
            'email'    => $request->email,
            'service_id'    => $request->subject,
            'status'   => 0,
        ]);

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

