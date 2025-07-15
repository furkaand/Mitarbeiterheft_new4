@extends('templates.layout')

@section('title', $instruction->topic)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('your_instructions.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Zurück zu den Unterweisungen</a>
        </div>
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-center">{{ $instruction->topic }}</h1>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>Unternehmen:</strong> {{ $instruction->company }}</p>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>Betriebsteil/Arbeitsbereich/Thema:</strong> {{ $instruction->topic }}</p>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>Durchgeführt am:</strong> {{ $instruction->conducted_on }}</p>
                <p><strong>Durchgeführt von:</strong> {{ $instruction->conducted_by }}</p>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <label for="content" class="block text-gray-700"><strong>Unterweisungsinhalte:</strong></label>
                <textarea id="content" name="content" class="border rounded w-full py-2 px-3" readonly>{{ $instruction->content }}</textarea>
            </div>
            <div class="text-center mb-4 p-4 bg-gray-100 rounded">
                <a href="{{ asset('storage/' . $instruction->pdf) }}" class="text-blue-500" target="_blank">PDF anzeigen</a>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <label class="block text-gray-700"><strong>Bestätigung:</strong></label>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="confirmation1" name="confirmation1" class="mr-2">
                    <label for="confirmation1">Ich habe den Verhaltenskodex gelesen</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="confirmation2" name="confirmation2" class="mr-2">
                    <label for="confirmation2">Ich habe mich für Rückfragen zur Verfügung gestellt</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="confirmation3" name="confirmation3" class="mr-2">
                    <label for="confirmation3">Ich bestätige, dass ich an der Unterweisung teilgenommen habe</label>
                </div>
            </div>
        </div>
    </div>
@endsection
