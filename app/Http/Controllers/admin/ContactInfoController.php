<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        $contact = ContactInfo::firstOrCreate(['id' => 1]);
        return view('backend.contact-info.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'whatsapp' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'map_link' => 'nullable|url',
            'top_header_title' => 'nullable|string|max:255',
            'fb_url' => 'nullable|url',
            'insta_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

        $contact = ContactInfo::first();
        $contact->update($request->all());

        return redirect()->back()->with('success', 'Contact information updated successfully!');
    }
}

