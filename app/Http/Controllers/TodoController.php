<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TodoController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())
                    ->orderBy('due_date', 'asc')
                    ->orderBy('priority', 'desc')
                    ->get();
        
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after_or_equal:today',
            'priority' => 'required|in:low,medium,high',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('todos.index')->with('success', 'To-Do wurde erfolgreich erstellt.');
    }

    public function show(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()->route('todos.index')->with('success', 'To-Do wurde erfolgreich aktualisiert.');
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'To-Do wurde erfolgreich gelöscht.');
    }

    public function toggleStatus(Todo $todo)
    {
        if ($todo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $newStatus = $todo->status === 'completed' ? 'pending' : 'completed';
        $todo->update(['status' => $newStatus]);

        return redirect()->route('todos.index')->with('success', 'To-Do Status wurde geändert.');
    }
}
