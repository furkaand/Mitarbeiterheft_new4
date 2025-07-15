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

    <h2 class="text-3xl font-bold text-blue-600 mb-6">Neue Unterweisung erstellen</h2>

    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
        <ul class="flex border-b mb-6">
            <li class="-mb-px mr-1">
                <a class="bg-blue-500 inline-block border-l border-t border-r rounded-t py-2 px-4 text-white font-semibold" href="#tab1" onclick="showTab(event, 'tab1')">Allgemein</a>
            </li>
            <li class="mr-1">
                <a class="bg-gray-200 inline-block py-2 px-4 text-blue-700 font-semibold hover:bg-blue-100" href="#tab2" onclick="showTab(event, 'tab2')">Workflow</a>
            </li>
        </ul>
        <form action="{{ route('instructions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="tab1" class="tab-content">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Thema</label>
                    <input type="text" name="topic" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Bild/PDF</label>
                    <input type="file" name="pdf" accept="application/pdf,image/*" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Benutzer zuweisen</label>
                    <select name="user_id" class="w-full border rounded px-3 py-2">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="tab2" class="tab-content hidden">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Gültigkeit</label>
                    <input type="date" name="valid_until" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Erinnerung senden Ablauf</label>
                    <input type="date" name="reminder_date" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Karenzzeit (Tage)</label>
                    <input type="number" name="grace_period" class="w-full border rounded px-3 py-2" min="0">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">End-Empfänger</label>
                    <input type="text" name="final_recipient" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Bestätigung durch Mitarbeiter</label>
                    <select name="confirmation_required" class="w-full border rounded px-3 py-2">
                        <option value="1">Ja</option>
                        <option value="0">Nein</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Erinnerung senden an</label>
                    <input type="text" name="reminder_recipients" class="w-full border rounded px-3 py-2" placeholder="E-Mail(s) durch Komma trennen">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Workflow</label>
                    <textarea name="workflow" class="w-full border rounded px-3 py-2"></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Erstellen</button>
            </div>
        </form>
    </div>
</div>
<script>
function showTab(evt, tabId) {
    evt.preventDefault();
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById(tabId).classList.remove('hidden');
    document.querySelectorAll('ul.flex.border-b a').forEach(a => a.classList.remove('bg-blue-500', 'text-white'));
    evt.target.classList.add('bg-blue-500', 'text-white');
}

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
