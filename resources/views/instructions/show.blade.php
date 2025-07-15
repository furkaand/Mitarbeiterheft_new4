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

        <h2 class="text-3xl font-bold text-blue-600 mb-6">{{ $instruction->topic }}</h2>
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-center">{{ $instruction->topic }}</h1>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>Unternehmen:</strong> {{ $instruction->company }}</p>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>Betriebsteil/Arbeitsbereich/Thema:</strong> {{ $instruction->topic }}</p>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <p><strong>Durchgeführt am:</strong> {{ $instruction->conducted_on }}</p>
                <p><strong>Durchgeführt von:</strong> {{ $instruction->conducted_by }}</p>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <label for="content" class="block text-gray-700"><strong>Unterweisungsinhalte:</strong></label>
                <textarea id="content" name="content" class="border rounded w-full py-2 px-3" readonly>{{ $instruction->content }}</textarea>
            </div>
            <div class="text-center mb-4 p-4 bg-gray-100 rounded">
                <a href="{{ asset('storage/' . $instruction->pdf) }}" class="text-blue-500" target="_blank">PDF anzeigen</a>
            </div>
            <div class="mb-4 p-4 bg-gray-100 rounded">
                <label class="block text-gray-700"><strong>Bestätigung:</strong></label>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="confirmation1" name="confirmation1" class="mr-2">
                    <label for="confirmation1">Ich habe den Verhaltenskodex gelesen</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="confirmation2" name="confirmation2" class="mr-2">
                    <label for="confirmation2">Ich habe mich für Rückfragen zur Verfügung gestellt</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="confirmation3" name="confirmation3" class="mr-2">
                    <label for="confirmation3">Ich habe die Unterweisung verstanden</label>
                </div>
            </div>
        </div>
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
