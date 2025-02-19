@extends('templates.layout')

@section('title', 'Schichtplan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-4">
            <button type="button" onclick="window.location.href='{{ route('schedule.create') }}'" class="bg-blue-500 text-white px-4 py-2 rounded">
                Neue Schicht
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($shifts as $shift)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">
                        <h2 class="text-xl font-bold text-gray-800 truncate">{{ $shift->employee->first_name }} {{ $shift->employee->last_name }}</h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Personalnummer: {{ $shift->employee->employee_number }}
                        </p>
                        <p class="mt-2 text-sm text-gray-600">
                            Datum: {{ $shift->date }}
                        </p>
                        <p class="mt-2 text-sm text-gray-600">
                            Schicht: {{ $shift->shift_type }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
