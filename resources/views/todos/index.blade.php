@extends('templates.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Back button -->
        <div class="mb-4">
            <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-900 transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="text-base font-medium">Zurück</span>
            </button>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Erfolg!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header with buttons -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-blue-600">To-Do Liste</h1>
                <p class="text-gray-600 mt-2">Hier hast du eine Übersicht deiner To-Dos.</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('todos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    To-Do erstellen
                </a>
            </div>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pending Tasks -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-yellow-600">Ausstehend</h2>
            @foreach($todos->where('status', 'pending') as $todo)
                <div class="border border-gray-200 rounded-lg p-4 mb-3 {{ $todo->due_date && $todo->due_date->isPast() ? 'border-red-300 bg-red-50' : '' }}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $todo->title }}</h3>
                            @if($todo->description)
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($todo->description, 50) }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $todo->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                       ($todo->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($todo->priority) }}
                                </span>
                                @if($todo->due_date)
                                    <span class="text-xs text-gray-500">
                                        Fällig: {{ $todo->due_date->format('d.m.Y') }}
                                        @if($todo->due_date->isPast())
                                            <span class="text-red-600 font-medium">(Überfällig)</span>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-2">
                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 hover:text-green-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            </form>
                            <a href="{{ route('todos.edit', $todo) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Sind Sie sicher, dass Sie diese To-Do löschen möchten?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($todos->where('status', 'pending')->isEmpty())
                <p class="text-gray-500 text-center py-8">Keine ausstehenden To-Dos</p>
            @endif
        </div>

        <!-- In Progress Tasks -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-blue-600">In Bearbeitung</h2>
            @foreach($todos->where('status', 'in_progress') as $todo)
                <div class="border border-gray-200 rounded-lg p-4 mb-3">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $todo->title }}</h3>
                            @if($todo->description)
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($todo->description, 50) }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $todo->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                       ($todo->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($todo->priority) }}
                                </span>
                                @if($todo->due_date)
                                    <span class="text-xs text-gray-500">
                                        Fällig: {{ $todo->due_date->format('d.m.Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-2">
                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 hover:text-green-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            </form>
                            <a href="{{ route('todos.edit', $todo) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Sind Sie sicher, dass Sie diese To-Do löschen möchten?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($todos->where('status', 'in_progress')->isEmpty())
                <p class="text-gray-500 text-center py-8">Keine To-Dos in Bearbeitung</p>
            @endif
        </div>

        <!-- Completed Tasks -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4 text-green-600">Abgeschlossen</h2>
            @foreach($todos->where('status', 'completed') as $todo)
                <div class="border border-gray-200 rounded-lg p-4 mb-3 bg-green-50">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900 line-through">{{ $todo->title }}</h3>
                            @if($todo->description)
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($todo->description, 50) }}</p>
                            @endif
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Abgeschlossen
                                </span>
                                @if($todo->due_date)
                                    <span class="text-xs text-gray-500">
                                        Fällig war: {{ $todo->due_date->format('d.m.Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-2">
                            <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Sind Sie sicher, dass Sie diese To-Do löschen möchten?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($todos->where('status', 'completed')->isEmpty())
                <p class="text-gray-500 text-center py-8">Keine abgeschlossenen To-Dos</p>
            @endif
        </div>
    </div>
@endsection
