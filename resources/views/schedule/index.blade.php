@extends('templates.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Back button -->
        <div class="mb-6">
            <button onclick="goBackToDashboard()" class="flex items-center text-blue-600 hover:text-blue-800 text-base font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Zurück
            </button>
        </div>

        <h2 class="text-3xl font-bold text-blue-600 mb-2">Schichtplan</h2>
        <p class="text-gray-600 mb-6">Hier kannst du deine Schichten einsehen, neue Schichten eintragen und den aktuellen Monatsplan verwalten.</p>
        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('schedule.index') }}" class="flex items-center gap-2">
                <label for="month" class="font-semibold">Monat:</label>
                <select name="month" id="month" class="border rounded px-7 py-1">
                    @foreach($months as $m)
                        <option value="{{ $m['value'] }}" @if($m['value'] == $month) selected @endif>{{ \Carbon\Carbon::createFromFormat('Y-m', $m['value'])->format('m/Y') }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Anzeigen</button>
            </form>
            <a href="{{ route('schedule.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Schicht eintragen</a>
        </div>

        <div class="mb-4 text-xl font-bold">
            {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->locale('de')->isoFormat('MMMM YYYY') }}
        </div>
        
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
                @foreach($users as $user)
                    <tr>
                        <td class="py-2 px-4 border border-gray-400">{{ $user->id }}</td>
                        <td class="py-2 px-4 border border-gray-400">{{ $user->lastname }}</td>
                        <td class="py-2 px-4 border border-gray-400">{{ $user->firstname }}</td>
                        @foreach($weeks as $week)
                            @foreach($week['days'] as $day)
                                <td class="py-2 px-4 border border-gray-400">
                                    @foreach($shifts as $shift)
                                        @if($shift->user_id == $user->id && $shift->date == $day['date'])
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

<script>
function goBackToDashboard() {
    // Check if we came from within the same module or directly
    const referrer = document.referrer;
    const currentPath = window.location.pathname;
    
    // If we came from the dashboard or no referrer, go to dashboard
    if (!referrer || referrer.includes('/') && !referrer.includes(currentPath.split('/')[1])) {
        window.location.href = "{{ route('dashboard') }}";
    } else {
        // If we're deep in the module, go back one step, otherwise go to dashboard
        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = "{{ route('dashboard') }}";
        }
    }
}
</script>
@endsection
