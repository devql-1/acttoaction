<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotSupportTicket;
use Illuminate\Http\Request;

class ChatbotSupportTicketController extends Controller
{
    public function index()
    {
        $tickets = ChatbotSupportTicket::latest()->get();
        $newCount = ChatbotSupportTicket::where('status', 'new')->count();
        return view('backend.chatbot.support_tickets.index', compact('tickets', 'newCount'));
    }

    public function show($id)
    {
        $ticket = ChatbotSupportTicket::findOrFail($id);
        if ($ticket->status === 'new') {
            $ticket->status = 'read';
            $ticket->save();
        }
        return view('backend.chatbot.support_tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = ChatbotSupportTicket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();
        return response()->json(['success' => true, 'status' => $ticket->status]);
    }

    public function destroy($id)
    {
        ChatbotSupportTicket::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function newCount()
    {
        return response()->json(['count' => ChatbotSupportTicket::where('status', 'new')->count()]);
    }
}
