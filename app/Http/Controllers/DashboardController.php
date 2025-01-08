<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $allConversations = Conversation::where('user_id', $user->id)->get();
        $conversationId = $request->get('conversation_id', $allConversations->first()->id ?? null);
        $conversation = $conversationId ? Conversation::with('messages')->find($conversationId) : null;

        return view('dashboard', compact('user', 'conversation', 'allConversations', 'conversationId'));
    }
}
