@extends('templates.layout')

@section('title', 'Schulung bestätigen')

@section('content')
<div class="max-w-xl mx-auto">
    <!-- Back button -->
    <div class="mb-4">
        <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-900 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-base font-medium">Zurück</span>
        </button>
    </div>

    <h2 class="text-2xl font-bold text-blue-700 mb-4">Schulung bestätigen</h2>
    <form action="{{ route('trainings.confirm.store', $training->id) }}" method="POST" class="bg-white p-8 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Unterschrift:</label>
            <input type="text" name="signature" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Unterschrift eintragen">
        </div>
        <div class="mb-6">
            <label class="block font-semibold mb-1">Datum:</label>
            <input type="text" name="date" value="{{ date('Y-m-d') }}" readonly class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow transition">Bestätigung speichern</button>
    </form>
</div>
@endsection
