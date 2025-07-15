@extends('templates.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Back button -->
    <div class="mb-4">
        <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-900 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-base font-medium">Zurück</span>
        </button>
    </div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-blue-600">Alle Unterweisungen</h1>
            <p class="text-gray-600 mt-2">Übersicht aller Unterweisungen nach Benutzer</p>
        </div>
    </div>
    @php
        $grouped = $instructions->groupBy(function($item) {
            return optional($item->user)->name ?? 'Unbekannt';
        });
    @endphp
    @forelse($grouped as $userName => $userInstructions)
        @if($userName !== 'Unbekannt' && $userInstructions->count())
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-blue-700 mb-2">{{ $userName }}</h3>
                <table class="min-w-full bg-white mb-2">
                    <thead>
                        <tr>
                            <th class="py-2">Thema</th>
                            <th class="py-2">Unternehmen</th>
                            <th class="py-2">PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userInstructions as $instruction)
                            <tr>
                                <td class="border px-4 py-2">{{ $instruction->topic }}</td>
                                <td class="border px-4 py-2">{{ $instruction->company }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ Storage::url($instruction->pdf) }}" class="text-blue-500" target="_blank">PDF anzeigen</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @empty
        <p class="text-gray-700">Keine Unterweisungen vorhanden.</p>
    @endforelse
</div>
@endsection
