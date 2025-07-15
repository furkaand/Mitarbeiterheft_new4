<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        // Zeigt die Chat-Übersicht an
        return view('chat.index');
    }

    public function search(Request $request)
    {
        // Sucht nach Mitarbeitern
        $query = $request->input('query');
        // Beispiel: User::where('name', 'like', "%$query%")...
        return response()->json([]);
    }

    public function sendMessage(Request $request)
    {
        // Speichert eine neue Chat-Nachricht
        // ...
        return response()->json(['success' => true]);
    }
}
