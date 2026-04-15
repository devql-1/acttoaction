<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'  => 'required|email|max:255',
            'source' => 'nullable|string|max:50',
        ]);

        $email = strtolower(trim($request->email));

        $existing = Newsletter::where('email', $email)->first();

        if ($existing) {
            if ($existing->status === 'unsubscribed') {
                $existing->update(['status' => 'active', 'source' => $request->input('source', 'general')]);
                return response()->json([
                    'status'  => 200,
                    'message' => 'Welcome back! You have been re-subscribed.',
                ]);
            }
            return response()->json([
                'status'  => 409,
                'message' => 'You are already subscribed!',
            ], 409);
        }

        Newsletter::create([
            'email'      => $email,
            'source'     => $request->input('source', 'general'),
            'ip_address' => $request->ip(),
            'status'     => 'active',
        ]);

        return response()->json([
            'status'  => 200,
            'message' => 'Thank you for subscribing!',
        ]);
    }
}
