@extends('templates.layout')

@section('title', 'Schichtplan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        
        <table class="min-w-full bg-white border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="py-2 px-4 border border-gray-400" rowspan="3">Personalnummer</th>
                    <th class="py-2 px-4 border border-gray-400" rowspan="3">Name</th>
                    <th class="py-2 px-4 border border-gray-400" rowspan="3">Vorname</th>
                    @foreach($weeks as $week)
                        <th class="py-2 px-4 border border-gray-400" colspan="{{ count($week['days']) }}">{{ $week['kw'] }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($weeks as $week)
                        @foreach($week['days'] as $day)
                            <th class="py-2 px-4 border border-gray-400">{{ $day['month'] }}</th>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    @foreach($weeks as $week)
                        @foreach($week['days'] as $day)
                            <th class="py-2 px-4 border border-gray-400">{{ $day['date'] }}<br>{{ $day['day'] }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td class="py-2 px-4 border border-gray-400">{{ $employee->personal_number }}</td>
                        <td class="py-2 px-4 border border-gray-400">{{ $employee->last_name }}</td>
                        <td class="py-2 px-4 border border-gray-400">{{ $employee->first_name }}</td>
                        @foreach($weeks as $week)
                            @foreach($week['days'] as $day)
                                <td class="py-2 px-4 border border-gray-400">
                                    @foreach($shifts as $shift)
                                        @if($shift->employee_id == $employee->id && $shift->date == $day['date'])
                                            {{ $shift->shift_type }}
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
