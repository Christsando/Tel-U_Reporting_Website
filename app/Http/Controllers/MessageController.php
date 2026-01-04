<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\LostFoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'item'])
            ->where('receiver_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.messages.index', compact('messages'));
    }

    public function store(Request $request, $item_id)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $item = LostFoundItem::findOrFail($item_id);

        if ($item->user_id === Auth::id()) {
            return back()->with('error', 'Tidak bisa mengirim pesan ke diri sendiri.');
        }

        Message::create([
            'sender_id'          => Auth::id(),
            'receiver_id'        => $item->user_id,
            'lost_found_item_id' => $item->id,
            'message'            => $request->message,
        ]);

        return back()->with('success', 'Pesan terkirim aman! Tunggu balasan di Inbox.');
    }
    public function reply(Request $request, $message_id)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $originalMessage = Message::findOrFail($message_id);

        if ($originalMessage->receiver_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak membalas pesan ini.');
        }

        Message::create([
            'sender_id'        => Auth::id(), 
            'receiver_id'      => $originalMessage->sender_id, 
            'lost_found_item_id' => $originalMessage->lost_found_item_id, 
            'message'          => $request->message,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }
}