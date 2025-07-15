@extends('templates.layout')

@section('title', $article->title)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end items-center mb-4">
    
            <button type="button" onclick="window.history.back()" class="bg-blue-500 text-white px-4 py-2 rounded">
                Zurück
            </button>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-3xl mx-auto">
        <img src="{{ route('images.show', ['filename' => basename($article->image)]) }}" alt="{{ $article->title }}" class="h-48 w-full object-cover">

            <div class="p-4">
                <p class="mt-4 text-gray-600">
                    {!! $article->content !!}
                </p>
            </div>
        </div>
    </div>
@endsection
