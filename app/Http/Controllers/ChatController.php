<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Zeigt die Chat-Übersicht an
        return view('chat.index');
    }

    public function getAllUsers()
    {
        $users = User::where('id', '!=', Auth::id())
            ->orderBy('firstname')
            ->orderBy('lastname')
            ->get(['id', 'firstname', 'lastname', 'email']);
        return response()->json($users);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            // Wenn keine Suchanfrage vorhanden ist, alle Benutzer zurückgeben
            return $this->getAllUsers();
        }
        
        $users = User::where(function($q) use ($query) {
            $q->where('firstname', 'like', "%$query%")
              ->orWhere('lastname', 'like', "%$query%")
              ->orWhere('email', 'like', "%$query%");
        })
        ->where('id', '!=', Auth::id())
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->limit(10)
        ->get(['id', 'firstname', 'lastname', 'email']);
        return response()->json($users);
    }

    public function getMessages(Request $request)
    {
        $userId = Auth::id();
        $otherId = $request->input('user_id');
        $messages = Message::where(function($q) use ($userId, $otherId) {
            $q->where('sender_id', $userId)->where('receiver_id', $otherId);
        })->orWhere(function($q) use ($userId, $otherId) {
            $q->where('sender_id', $otherId)->where('receiver_id', $userId);
        })->orderBy('created_at')->get();
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $userId = Auth::id();
        $receiverId = $request->input('receiver_id');
        $message = Message::create([
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $request->input('message'),
        ]);
        return response()->json(['success' => true, 'message' => $message]);
    }
}
