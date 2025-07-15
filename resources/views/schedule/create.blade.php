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

        <h2 class="text-3xl font-bold text-blue-600 mb-6">Neue Schicht erstellen</h2>

        <form action="{{ route('schedule.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Datum</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full">
            </div>
            <div class="mb-4">
                <label for="shift_type" class="block text-gray-700">Schichttyp</label>
                <select name="shift_type" id="shift_type" class="mt-1 block w-full">
                    <option value="Frühschicht">Frühschicht</option>
                    <option value="Normalschicht">Normalschicht</option>
                    <option value="Spätschicht">Spätschicht</option>
                    <option value="Nachtschicht">Nachtschicht</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="user_id" class="block text-gray-700">Mitarbeiter</label>
                <select name="user_id" id="user_id" class="mt-1 block w-full" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Schicht erstellen</button>
            </div>
        </form>
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
