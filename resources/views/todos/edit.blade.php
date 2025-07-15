@extends('templates.layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back button -->
    <div class="mb-4">
        <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-900 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-base font-medium">Zurück</span>
        </button>
    </div>

    <h2 class="text-2xl font-bold text-blue-700 mb-4">To-Do bearbeiten</h2>
    <p class="mb-6 text-gray-600">Hier kannst du deine To-Do bearbeiten und den Status ändern.</p>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Fehler!</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('todos.update', $todo) }}" method="POST" class="bg-white p-8 rounded shadow-md">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-1">
                        Titel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $todo->title) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" 
                           required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block font-semibold mb-1">
                        Beschreibung
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $todo->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="block font-semibold mb-1">
                        Fälligkeitsdatum
                    </label>
                    <input type="date" 
                           id="due_date" 
                           name="due_date" 
                           value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d') : '') }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label for="priority" class="block font-semibold mb-1">
                        Priorität <span class="text-red-500">*</span>
                    </label>
                    <select id="priority" 
                            name="priority" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="low" {{ old('priority', $todo->priority) === 'low' ? 'selected' : '' }}>Niedrig</option>
                        <option value="medium" {{ old('priority', $todo->priority) === 'medium' ? 'selected' : '' }}>Mittel</option>
                        <option value="high" {{ old('priority', $todo->priority) === 'high' ? 'selected' : '' }}>Hoch</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="status" class="block font-semibold mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" 
                            name="status" 
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="pending" {{ old('status', $todo->status) === 'pending' ? 'selected' : '' }}>Ausstehend</option>
                        <option value="in_progress" {{ old('status', $todo->status) === 'in_progress' ? 'selected' : '' }}>In Bearbeitung</option>
                        <option value="completed" {{ old('status', $todo->status) === 'completed' ? 'selected' : '' }}>Abgeschlossen</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('todos.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Abbrechen
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        To-Do aktualisieren
                    </button>
            </form>
        </div>
    </div>
@endsection
