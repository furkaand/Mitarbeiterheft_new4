<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruction;
use App\Models\User; // Füge dies hinzu
use Illuminate\Support\Facades\Auth;

class AllInstructionsController extends Controller
{
    public function index()
    {
        $instructions = Instruction::all();
        return view('all_instructions.index', compact('instructions'));
    }

    public function create()
    {
        $users = User::all();
        return view('all_instructions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf',
        ]);

        $instruction = new Instruction();
        $instruction->topic = $request->topic;
        $instruction->company = 'E.Winkemann GmbH'; // Fest vorgegeben
        $instruction->pdf = $request->file('pdf')->store('pdfs');
        $instruction->user_id = Auth::id(); // Verknüpfen mit dem Benutzer
        $instruction->save();

        return redirect()->route('all_instructions.index')->with('success', 'Unterweisung erstellt');
    }
}
