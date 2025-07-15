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

        <h2 class="text-3xl font-bold text-blue-600 mb-2">Deine Unterweisungen</h2>
        <p class="text-gray-600 mb-6">Hier findest du deine aktuellen und vergangenen Unterweisungen. Du kannst neue Unterweisungen erstellen, bestehende einsehen und PDF-Dokumente herunterladen.</p>
        <div class="flex justify-end mb-4 gap-2">
            <button type="button" onclick="goToCreate()" class="bg-blue-500 text-white px-4 py-2 rounded">
                Neue Unterweisung
            </button>
            <button type="button" onclick="goToAll()" class="bg-blue-500 text-white px-4 py-2 rounded">
                Alle Unterweisungen
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
                        <th class="py-2">Typ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instructions as $instruction)
                        <tr @if($instruction->isMine) class="bg-blue-50" @endif>
                            <td class="border px-4 py-2">{{ $instruction->topic }}</td>
                            <td class="border px-4 py-2">E.Winkemann GmbH</td>
                            <td class="border px-4 py-2">{{ $instruction->conducted_on }}</td>
                            <td class="border px-4 py-2">{{ $instruction->conducted_by }}</td>
                            <td class="border px-4 py-2">{{ $instruction->confirmed_by }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ Storage::url($instruction->pdf) }}" class="text-blue-500" target="_blank">PDF anzeigen</a>
                            </td>
                            <td class="border px-4 py-2">{{ $instruction->status }}</td>
                            <td class="border px-4 py-2">
                                @if($instruction->isMine)
                                    <span class="text-green-600 font-bold">Deine</span>
                                @else
                                    <span class="text-gray-500">Alle</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
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

function goToCreate() {
    window.location.href = "{{ route('instructions.create') }}";
}

function goToAll() {
    window.location.href = "{{ route('instructions.all') }}";
}
</script>
@endsection
