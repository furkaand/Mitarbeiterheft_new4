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
                <!-- Textarea für TinyMCE -->
                <textarea name="content" id="content" class="w-full border-gray-300 rounded-md shadow-sm" rows="10" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Artikel erstellen</button>
        </form>
    </div>

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/o2049f5wm8swfd0pj11ayyaxqljhi12pxxibeqn2dyejy2e3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        // TinyMCE initialisieren
        tinymce.init({
            selector: '#content', // Textarea-ID
            plugins: 'advlist autolink lists link image charmap preview anchor table',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            height: 400,
            menubar: false,
            branding: false,
        });
    </script>
@endsection