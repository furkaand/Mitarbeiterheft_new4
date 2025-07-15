<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use Illuminate\Support\Facades\Auth;

class CalendarEventController extends Controller
{
    public function store(Request $request)
    {
        $event = CalendarEvent::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'user_id' => Auth::id(),
        ]);
        return response()->json($event);
    }

    public function index(Request $request)
    {
        $events = CalendarEvent::where('user_id', Auth::id())->get();
        return response()->json($events);
    }
}
