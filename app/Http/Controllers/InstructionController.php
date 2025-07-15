<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruction;
use Illuminate\Support\Facades\Auth;

class InstructionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instructions = Instruction::where('user_id', $user->id)->get();
        return view('instructions.index', compact('instructions'));
    }

    public function show($id)
    {
        $instruction = Instruction::findOrFail($id);
        return view('instructions.show', compact('instruction'));
    } 

    public function create()
    {
        $users = \App\Models\User::all();
        return view('instructions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf',
            'user_id' => 'nullable|exists:users,id',
            'valid_until' => 'nullable|date',
            'reminder_date' => 'nullable|date',
            'grace_period' => 'nullable|integer',
            'final_recipient' => 'nullable|string|max:255',
            'confirmation_required' => 'nullable|boolean',
            'reminder_recipients' => 'nullable|string|max:255',
            'workflow' => 'nullable|string',
        ]);

        $instruction = new Instruction();
        $instruction->topic = $request->topic;
        $instruction->company = 'E.Winkemann GmbH';
        $instruction->pdf = $request->file('pdf')->store('pdfs');
        $instruction->user_id = $request->user_id ?? Auth::id();
        $instruction->valid_until = $request->valid_until;
        $instruction->reminder_date = $request->reminder_date;
        $instruction->grace_period = $request->grace_period;
        $instruction->final_recipient = $request->final_recipient;
        $instruction->confirmation_required = $request->confirmation_required;
        $instruction->reminder_recipients = $request->reminder_recipients;
        $instruction->workflow = $request->workflow;
        $instruction->save();

        return redirect()->route('instructions.index')->with('success', 'Unterweisung erstellt');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'conducted_on' => 'required|date',
            'conducted_by' => 'required|string|max:255',
            'confirmed_by' => 'required|string|max:255',
            'signature' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
 
        $instruction = Instruction::findOrFail($id);
        $instruction->conducted_on = $request->conducted_on;
        $instruction->conducted_by = $request->conducted_by;
        $instruction->confirmed_by = $request->confirmed_by;
        $instruction->signature = $request->signature;
        $instruction->content = $request->content;
        $instruction->save();
 
        return redirect()->route('instructions.show', $instruction->id)->with('success', 'Unterweisung aktualisiert');
    }

    public function all()
    {
        $instructions = Instruction::with('user')->get();
        return view('instructions.all', compact('instructions'));
    }
}
