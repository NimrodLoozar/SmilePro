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
        $conversation = $conversations->first();
        return view('messages.index', compact('conversations', 'conversation'));
    }

    public function adminIndex()
    {
        $conversations = Conversation::where('recipient', 'Hulpdesk')->with('user', 'messages.user')->get();
        $conversation = $conversations->first();
        return view('messages.index', compact('conversations', 'conversation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'recipient' => 'required|string|in:dentist,Hulpdesk',
        ]);

        $maxLength = 25; // Set your desired maximum length here

        if (strlen($request->content) > $maxLength) {
            return redirect()->back()->with('error', 'Bericht kan niet worden verzonden omdat het te lang is.');
        }

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

        $maxLength = 25; // Set your desired maximum length here

        if (strlen($request->content) > $maxLength) {
            return redirect()->back()->with('error', 'Bericht kan niet worden verzonden omdat het te lang is.');
        }

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

    public function update(Request $request, Conversation $conversation)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $maxLength = 25; // Set your desired maximum length here

        if (strlen($request->content) > $maxLength) {
            return redirect()->back()->with('error', 'Bericht kan niet worden bijgewerkt omdat het te lang is.');
        }

        $lastMessage = $conversation->messages()->where('user_id', Auth::id())->latest()->first();
        if ($lastMessage) {
            $lastMessage->content = $request->content;
            $lastMessage->save();
        }

        return redirect()->back()->with('success', 'Bericht succesvol bijgewerkt!');
    }

    public function deleteLastMessage(Request $request, Conversation $conversation)
    {
        $lastMessage = $conversation->messages()->where('user_id', Auth::id())->latest()->first();
        if ($lastMessage) {
            $lastMessage->delete();
        }

        return redirect()->route('dashboard', ['conversation_id' => $conversation->id])->with('success', 'Laatste bericht succesvol verwijderd!');
    }

    public function destroy(Conversation $conversation)
    {
        $conversation->delete();

        return redirect()->route('messages.index')->with('success', 'Gesprek succesvol verwijderd!');
    }

    public function deleteSelected(Request $request)
    {
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id',
        ]);

        Message::whereIn('id', $request->message_ids)->delete();

        return redirect()->route('messages.index')->with('success', 'Geselecteerde berichten succesvol verwijderd!');
    }
}
