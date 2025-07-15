@extends('templates.layout')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Erfolg</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-blue-700 mb-2">Willkommen, {{ auth()->user()->firstname ?? 'User' }}!</h1>
        <p class="text-gray-600">Hier findest du eine Übersicht deiner wichtigsten Daten und Aktionen.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white rounded shadow p-6 flex flex-col">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Meine To-Dos</h2>
            @php 
                $todos = \App\Models\Todo::where('user_id', auth()->id())
                    ->where('status', '!=', 'completed')
                    ->orderBy('due_date', 'asc')
                    ->orderBy('priority', 'desc')
                    ->take(5)
                    ->get(); 
            @endphp
            <div class="flex-1">
                @if($todos->count())
                    <ul>
                        @foreach($todos as $todo)
                            <li class="mb-2 border-b pb-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="font-semibold {{ $todo->due_date && $todo->due_date->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                                            {{ $todo->title }}
                                        </span>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                {{ $todo->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                                   ($todo->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($todo->priority) }}
                                            </span>
                                            @if($todo->due_date)
                                                <span class="text-xs {{ $todo->due_date->isPast() ? 'text-red-600' : 'text-gray-500' }}">
                                                    {{ $todo->due_date->format('d.m.Y') }}
                                                    @if($todo->due_date->isPast())
                                                        (Überfällig)
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-2">
                        <a href="{{ route('todos.index') }}" class="text-blue-600 hover:underline text-sm">Alle To-Dos anzeigen</a>
                    </div>
                @else
                    <p class="text-gray-500">Keine To-Dos vorhanden.</p>
                @endif
            </div>
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('todos.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow transition block text-center">Neue To-Do erstellen</a>
            </div>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Letzte Schulungen</h2>
            @php $trainings = \App\Models\Training::orderBy('date', 'desc')->take(5)->get(); @endphp
            <div class="flex-1">
                @if($trainings->count())
                    <ul>
                        @foreach($trainings as $training)
                            <li class="mb-2 border-b pb-2">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-semibold">{{ $training->purpose }}</span> <span class="text-gray-500">({{ $training->date }})</span><br>
                                        <span class="text-sm text-gray-600">Abteilung: {{ $training->department }}</span>
                                    </div>
                                    <a href="{{ route('trainings.show', $training->id) }}" class="text-blue-600 hover:underline">Anzeigen</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Keine Schulungen vorhanden.</p>
                @endif
            </div>
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('trainings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition block text-center">Neue Schulung anlegen</a>
            </div>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Letzte Artikel</h2>
            @php $articles = \App\Models\Article::orderBy('created_at', 'desc')->take(5)->get(); @endphp
            <div class="flex-1">
                @if($articles->count())
                    <ul>
                        @foreach($articles as $article)
                            <li class="mb-2 border-b pb-2">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-semibold">{{ $article->title }}</span>
                                    </div>
                                    <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:underline">Anzeigen</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">Keine Artikel vorhanden.</p>
                @endif
            </div>
            <div class="mt-4 pt-4 border-t">
                <a href="{{ route('articles.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow transition block text-center">Neuen Artikel anlegen</a>
            </div>
        </div>
        <div class="bg-white rounded shadow p-6 flex flex-col">
            <h2 class="text-xl font-semibold mb-4 text-blue-700">Kommende Termine</h2>
            @php 
                $upcomingEvents = \App\Models\CalendarEvent::where('user_id', auth()->id())
                    ->where('date', '>=', now()->toDateString())
                    ->orderBy('date', 'asc')
                    ->orderBy('time', 'asc')
                    ->take(3)
                    ->get(); 
            @endphp
            <div class="flex-1">
                @if($upcomingEvents->count())
                    <ul>
                        @foreach($upcomingEvents as $event)
                            <li class="mb-2 border-b pb-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="font-semibold text-gray-900">{{ $event->title }}</span>
                                        <div class="flex items-center gap-2 mt-1">
                                            @php
                                                $eventDate = \Carbon\Carbon::parse($event->date);
                                                $isToday = $eventDate->isToday();
                                                $isTomorrow = $eventDate->isTomorrow();
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                {{ $isToday ? 'bg-green-100 text-green-800' : ($isTomorrow ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                @if($isToday)
                                                    Heute
                                                @elseif($isTomorrow)
                                                    Morgen
                                                @else
                                                    {{ $eventDate->format('d.m.Y') }}
                                                @endif
                                            </span>
                                            @if($event->time)
                                                <span class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($event->time)->format('H:i') }} Uhr
                                                </span>
                                            @endif
                                        </div>
                                        @if($event->description)
                                            <p class="text-xs text-gray-600 mt-1">{{ Str::limit($event->description, 40) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <p class="text-gray-500">Keine kommenden Termine.</p>
                @endif
            </div>
            <div class="mt-2 ">
                <a href="{{ route('calendar.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded shadow transition block text-center">Neuen Termin erstellen</a>
            </div>
        </div>
    </div>
@endsection
