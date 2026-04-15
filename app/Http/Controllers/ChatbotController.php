<?php

namespace App\Http\Controllers;

use App\Models\ChatbotFaq;
use App\Models\ChatbotSupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatbotController extends Controller
{
    /**
     * Return active FAQs as JSON for the frontend chatbot.
     */
    public function faqs()
    {
        $faqs = ChatbotFaq::where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get(['id', 'question', 'answer']);

        return response()->json($faqs);
    }

    /**
     * Store a support ticket submitted from the chatbot.
     */
    public function submitTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'mobile'  => 'required|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
            ], 422);
        }

        ChatbotSupportTicket::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'mobile'  => $request->mobile,
            'message' => $request->message,
            'status'  => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been received! Our team will get back to you on your email & mobile soon.',
        ]);
    }
}
