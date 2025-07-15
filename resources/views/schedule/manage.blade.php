@extends('templates.layout')

@section('title', 'Schichten verwalten')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Schichten verwalten</h1>

        <!-- Übersicht des Schichtplans -->
        <table class="min-w-full bg-white mb-8">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Datum</th>
                    <th class="py-2 px-4 border-b">Schichttyp</th>
                    <th class="py-2 px-4 border-b">Mitarbeiter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shifts as $shift)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $shift->date }}</td>
                        <td class="py-2 px-4 border-b">{{ $shift->shift_type }}</td>
                        <td class="py-2 px-4 border-b">{{ $shift->user->firstname }} {{ $shift->user->lastname }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Button zum Hinzufügen neuer Schichten -->
        <div class="flex justify-end mb-4">
            <button type="button" onclick="window.location.href='{{ route('schedule.create') }}'" class="bg-blue-500 text-white px-4 py-2 rounded">
                Neue Schicht
            </button>
        </div>
    </div>
@endsection
