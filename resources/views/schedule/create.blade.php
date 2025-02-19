@extends('templates.layout')

@section('title', 'Neue Schicht erstellen')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <form action="{{ route('schedule.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Datum</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="shift_type" class="block text-gray-700">Schichttyp</label>
                <input type="text" name="shift_type" id="shift_type" class="mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="employee_id" class="block text-gray-700">Mitarbeiter</label>
                <select name="employee_id" id="employee_id" class="mt-1 block w-full" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Schicht erstellen</button>
            </div>
        </form>
    </div>
@endsection
