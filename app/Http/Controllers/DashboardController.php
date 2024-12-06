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
        $conversations = Conversation::where('id', $conversationId)->with('messages')->get();

        return view('dashboard', compact('user', 'conversations', 'allConversations', 'conversationId'));
    }
}
