<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'dentist') {
            $conversations = Conversation::where('recipient', 'dentist')->with('user', 'messages.user')->get();
        } elseif ($user->role === 'admin') {
            $conversations = Conversation::where('recipient', 'Hulpdesk')->with('user', 'messages.user')->get();
        } else {
            return redirect('/home');
        }
        return view('messages.index', compact('conversations'));
    }

    public function adminIndex()
    {
        $conversations = Conversation::where('recipient', 'Hulpdesk')->with('user', 'messages.user')->get();
        return view('messages.index', compact('conversations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'recipient' => 'required|string|in:dentist,Hulpdesk',
        ]);

        $conversation = Conversation::firstOrCreate([
            'user_id' => Auth::id(),
            'recipient' => $request->recipient,
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('dashboard', ['conversation_id' => $conversation->id])->with('success', 'Bericht succesvol verzonden!');
    }

    public function reply(Request $request, Conversation $conversation)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Antwoord succesvol verzonden!');
    }

    public function markAsRead(Message $message)
    {
        $message->is_read = true;
        $message->save();

        return redirect()->route('messages.index');
    }

    public function createConversation(Request $request)
    {
        $request->validate([
            'recipient' => 'required|string|in:dentist,Hulpdesk',
        ]);

        // Create a new conversation
        $conversation = Conversation::create([
            'user_id' => Auth::id(),
            'recipient' => $request->recipient,
        ]);

        return redirect()->route('dashboard', ['conversation_id' => $conversation->id])->with('success', 'Nieuw gesprek succesvol aangemaakt!');
    }
}
