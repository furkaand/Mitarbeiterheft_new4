@extends('templates.layout')

@section('title', 'Neuer Artikel')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Neuer Artikel</h1>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Titel</label>
                <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Bild</label>
                <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700">Textfeld</label>
                <textarea name="content" id="content" class="w-full border-gray-300 rounded-md shadow-sm" rows="10" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Artikel erstellen</button>
        </form>
    </div>
@endsection
