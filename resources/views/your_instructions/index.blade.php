@extends('templates.layout')

@section('title', 'Deine Unterweisungen')

@section('content')
    <div class="container mx-auto px-4 py-10">
        @if($instructions->isEmpty())
            <p class="text-gray-700">Keine Unterweisungen vorhanden.</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($instructions as $instruction)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h2 class="text-xl font-bold mb-2">{{ $instruction->topic }}</h2>
                        <a href="{{ route('your_instructions.show', ['id' => $instruction->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded block text-center">Unterweisung öffnen</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
