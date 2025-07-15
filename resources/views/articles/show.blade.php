@extends('templates.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('articles.index') }}" class="flex items-center text-blue-600 hover:text-blue-800 text-base font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Zurück zu den Artikeln
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Erfolg!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Fehler!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Article Content -->
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Article Image -->
            @if($article->image)
                <div class="w-full h-64 md:h-96 overflow-hidden">
                    <img src="{{ route('images.show', basename($article->image)) }}" alt="{{ $article->title }}" class="w-full h-full object-contain">
                </div>
            @endif

            <!-- Article Header -->
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
                
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Von {{ $article->user->firstname ?? 'Unbekannt' }} {{ $article->user->lastname ?? '' }}
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4M5 7h14a1 1 0 011 1v9a2 2 0 01-2 2H6a2 2 0 01-2-2V8a1 1 0 011-1z"></path>
                            </svg>
                            {{ $article->created_at->format('d.m.Y \u\m H:i') }} Uhr
                        </span>
                    </div>
                    
                    @if(auth()->user()->id === $article->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('articles.edit', $article) }}" class="flex items-center px-3 py-1 text-sm bg-yellow-100 text-yellow-800 rounded-md hover:bg-yellow-200 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Bearbeiten
                            </a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Artikel löschen möchten?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center px-3 py-1 text-sm bg-red-100 text-red-800 rounded-md hover:bg-red-200 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Löschen
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Article Content -->
            <div class="p-6">
                <div class="prose prose-lg max-w-none">
                    @if($article->content)
                        {!! $article->content !!}
                    @else
                        <p class="text-gray-400 italic">Kein Inhalt vorhanden</p>
                    @endif
                </div>
            </div>
        </article>

        <!-- Navigation -->
        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('articles.index') }}" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Alle Artikel anzeigen
            </a>
            
            <a href="{{ route('articles.create') }}" class="flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Neuen Artikel erstellen
            </a>
        </div>
    </div>
@endsection
