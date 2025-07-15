@extends('templates.layout')

@section('title', 'News')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-4">
            <button type="button" onclick="window.location.href='{{ route('articles.create') }}'" class="bg-blue-500 text-white px-4 py-2 rounded">
                Neuer Artikel
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ route('images.show', ['filename' => basename($article->image)]) }}" alt="{{ $article->title }}" class="h-48 w-full object-cover">

                    <div class="p-4">
                        <h2 class="text-xl font-bold text-gray-800 truncate">{{ $article->title }}</h2>

                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                            {!! Str::words(strip_tags($article->content), 100, '...') !!}
                        </p>

                        <a href="{{ route('articles.show', $article->id) }}" class="block mt-4 text-blue-600 hover:underline text-sm font-semibold">
                            Mehr lesen
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
