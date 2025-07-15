@extends('templates.layout')

@section('title', 'Schulungsdetails')

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

    <h2 class="text-2xl font-bold text-blue-700 mb-2">Schulungsdetails</h2>
    <div class="bg-white p-6 rounded shadow mb-6 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2">
        <div><span class="font-semibold">Abteilung:</span><br>{{ $training->department }}</div>
        <div><span class="font-semibold">Kostenstelle:</span><br>{{ $training->cost_center }}</div>
        <div class="sm:col-span-2"><span class="font-semibold">Ziel der Maßnahme:</span><br>{{ $training->purpose }}</div>
        <div><span class="font-semibold">Termin:</span><br>{{ $training->date }}</div>
        <div><span class="font-semibold">Teilnehmer:</span><br>{{ $training->participants }}</div>
        <div><span class="font-semibold">Veranstalter:</span><br>{{ $training->organizer }}</div>
        <div><span class="font-semibold">Kosten geplant:</span><br>{{ $training->planned_costs }} €</div>
        <div><span class="font-semibold">Beantragt von:</span><br>{{ $training->requested_by }}</div>
        @if($training->confirmation)
            @php $confirmation = json_decode($training->confirmation, true); @endphp
            <div class="sm:col-span-2 bg-green-50 border border-green-200 rounded p-4 mt-4">
                <span class="font-semibold">Bestätigt am:</span> {{ $confirmation['date'] ?? '' }}<br>
                <span class="font-semibold">Unterschrift:</span> {{ $confirmation['signature'] ?? '' }}
            </div>
        @endif
        @if($training->rejection_reason)
            <div class="sm:col-span-2 bg-red-50 border border-red-200 rounded p-4 mt-4">
                <span class="font-semibold">Abgelehnt</span><br>
                <span class="font-semibold">Begründung:</span> {{ $training->rejection_reason }}
            </div>
        @endif
    </div>
    @if(!$training->confirmation && !$training->rejection_reason)
    <form action="{{ route('trainings.confirm.store', $training->id) }}" method="POST" class="bg-white p-8 rounded shadow-md mb-6">
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
    @endif
</div>
@endsection
