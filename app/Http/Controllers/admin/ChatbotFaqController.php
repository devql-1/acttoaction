<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatbotFaqController extends Controller
{
    public function index()
    {
        $faqs = ChatbotFaq::orderBy('sort_order')->orderBy('id')->get();
        return view('backend.chatbot.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('backend.chatbot.faq.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
        ]);

        if ($validator->passes()) {
            ChatbotFaq::create([
                'question'   => $request->question,
                'answer'     => $request->answer,
                'sort_order' => $request->sort_order ?? 0,
                'status'     => 1,
            ]);
            return redirect()->route('admin.chatbot-faq')->with('success', 'Chatbot FAQ added successfully.');
        }

        return redirect()->back()->withInput()->withErrors($validator);
    }

    public function edit($id)
    {
        $faq = ChatbotFaq::findOrFail($id);
        return view('backend.chatbot.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
        ]);

        if ($validator->passes()) {
            $faq = ChatbotFaq::findOrFail($id);
            $faq->question   = $request->question;
            $faq->answer     = $request->answer;
            $faq->sort_order = $request->sort_order ?? 0;
            $faq->save();
            return redirect()->route('admin.chatbot-faq')->with('success', 'Chatbot FAQ updated successfully.');
        }

        return redirect()->back()->withInput()->withErrors($validator);
    }

    public function destroy($id)
    {
        ChatbotFaq::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function toggleStatus(Request $request)
    {
        $faq = ChatbotFaq::find($request->id);
        if ($faq) {
            $faq->status = $request->status;
            $faq->save();
            return response()->json(['success' => true, 'status' => $faq->status]);
        }
        return response()->json(['success' => false]);
    }
}
