@extends('templates.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('articles.show', $article) }}" class="flex items-center text-blue-600 hover:text-blue-800 text-base font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Zurück zum Artikel
            </a>
        </div>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-blue-600">Artikel bearbeiten</h1>
            <p class="text-gray-600 mt-2">Bearbeiten Sie Ihren Artikel</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Fehler!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titel *</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-300 @enderror" 
                           value="{{ old('title', $article->title) }}" 
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($article->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aktuelles Bild</label>
                        <div class="flex items-center space-x-4">
                            <img src="{{ route('images.show', basename($article->image)) }}" alt="{{ $article->title }}" class="w-32 h-32 object-cover rounded-md">
                            <div class="text-sm text-gray-600">
                                <p>Aktuelles Bild wird verwendet</p>
                                <p>Laden Sie ein neues Bild hoch, um es zu ersetzen</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $article->image ? 'Neues Bild hochladen (optional)' : 'Bild (optional)' }}
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-300 @enderror">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Unterstützte Formate: JPEG, PNG, JPG, GIF, SVG (max. 10MB)</p>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Inhalt (optional)</label>
                    <div id="editor-container" class="border border-gray-300 rounded-md">
                        <div id="editor" style="min-height: 300px;">{!! old('content', $article->content) !!}</div>
                    </div>
                    <input type="hidden" name="content" id="content" value="{{ old('content', $article->content) }}">
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('articles.show', $article) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Abbrechen
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Artikel aktualisieren
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quill.js CDN -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    
    <script>
        // Initialize Quill editor
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Bearbeiten Sie hier Ihren Artikel...'
        });

        // Set initial content
        quill.root.innerHTML = {!! json_encode(old('content', $article->content)) !!};

        // Update hidden input on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const content = quill.root.innerHTML;
            // Only set content if it's not empty or just empty paragraphs
            if (content && content.trim() !== '<p><br></p>' && content.trim() !== '') {
                document.querySelector('#content').value = content;
            } else {
                document.querySelector('#content').value = '';
            }
        });
    </script>
@endsection
