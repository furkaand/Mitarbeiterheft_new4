<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruction;
use Illuminate\Support\Facades\Auth;

class YourInstructionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instructions = Instruction::where('user_id', $user->id)->get();
        return view('your_instructions.index', compact('instructions'));
    }

    public function show($id)
    {
        $instruction = Instruction::findOrFail($id);
        return view('your_instructions.show', compact('instruction'));
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
 
        return redirect()->route('your_instructions.show', $instruction->id)->with('success', 'Unterweisung aktualisiert');
    }
}
