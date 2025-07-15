@extends('templates.layout')

@section('title', 'Alle Unterweisungen')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-4">
            <button type="button" onclick="window.location.href='{{ route('all_instructions.create') }}'" class="bg-blue-500 text-white px-4 py-2 rounded">
                Neue Unterweisung
            </button>
        </div>

        @if($instructions->isEmpty())
            <p class="text-gray-700">Keine Unterweisungen vorhanden.</p>
        @else
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Thema</th>
                        <th class="py-2">Unternehmen</th>
                        <th class="py-2">Durchgeführt am</th>
                        <th class="py-2">Durchgeführt von</th>
                        <th class="py-2">Wird bestätigt durch</th>
                        <th class="py-2">PDF</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instructions as $instruction)
                        @if($instruction->status == 'offen')
                            <tr>
                                <td class="border px-4 py-2">{{ $instruction->topic }}</td>
                                <td class="border px-4 py-2">E.Winkemann GmbH</td>
                                <td class="border px-4 py-2">{{ $instruction->conducted_on }}</td>
                                <td class="border px-4 py-2">{{ $instruction->conducted_by }}</td>
                                <td class="border px-4 py-2">{{ $instruction->confirmed_by }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ Storage::url($instruction->pdf) }}" class="text-blue-500" target="_blank">PDF anzeigen</a>
                                </td>
                                <td class="border px-4 py-2">{{ $instruction->status }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
