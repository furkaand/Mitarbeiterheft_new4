@extends('templates.layout')



@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Back button -->
    <div class="mb-4">
        <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-900 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-base font-medium">Zurück</span>
        </button>
    </div>

    <h2 class="text-2xl font-bold text-blue-700 mb-4">Neue Schulung anlegen</h2>
    <p class="mb-6 text-gray-600">Bitte fülle alle Felder aus, um eine neue Schulung zu erfassen.</p>
    <form action="{{ route('trainings.store') }}" method="POST" class="bg-white p-8 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Abteilung:</label>
            <input type="text" name="department" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Kostenstelle:</label>
            <input type="text" name="cost_center" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Ziel der Maßnahme:</label>
            <textarea name="purpose" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Termin:</label>
            <input type="date" name="date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Teilnehmer (kommagetrennt):</label>
            <input type="text" name="participants" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Veranstalter:</label>
            <input type="text" name="organizer" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Kosten geplant (€):</label>
            <input type="number" step="0.01" name="planned_costs" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-6">
            <label class="block font-semibold mb-1">Beantragt von:</label>
            <input type="text" name="requested_by" value="{{ auth()->user()->email }}" readonly class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow transition">Speichern</button>
    </form>
</div>
@endsection