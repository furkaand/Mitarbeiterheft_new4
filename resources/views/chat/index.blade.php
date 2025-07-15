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

    <h2 class="text-3xl font-bold text-blue-600 mb-2">Chat</h2>
    <p class="text-gray-600 mb-6">Hier kannst du mit anderen Mitarbeitern chatten, Nachrichten suchen und neue Unterhaltungen starten.</p>
    <div class="flex flex-col md:flex-row gap-6">
        <!-- User/Channel List -->
        <div class="w-full md:w-1/3 lg:w-1/4 bg-white border rounded shadow p-4 h-[32rem] overflow-y-auto">
            <div class="mb-4">
                <input type="text" id="user-search" placeholder="Mitarbeiter suchen..." class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <ul id="user-list">
                <!-- Dynamisch: Liste der User/Chats -->
            </ul>
        </div>
        <!-- Chat Window -->
        <div class="flex-1 flex flex-col bg-white border rounded shadow p-4 h-[32rem]">
            <div class="flex-1 overflow-y-auto mb-4" id="chat-window">
                <!-- Dynamisch: Nachrichtenverlauf -->
            </div>
            <form id="chat-form" class="flex">
                <input type="text" id="chat-message" class="flex-1 border border-gray-300 rounded-l px-3 py-2 focus:outline-none" placeholder="Nachricht eingeben...">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 rounded-r">Senden</button>
            </form>
        </div>
    </div>
</div>
<script>
let selectedUserId = null;

// Beim Laden der Seite alle Benutzer laden
$(document).ready(function() {
    loadAllUsers();
});

// Alle Benutzer laden
function loadAllUsers() {
    $.get("{{ route('chat.users') }}", function(users) {
        displayUsers(users);
    }).fail(function() {
        console.error('Fehler beim Laden der Benutzer');
    });
}

// Benutzer anzeigen
function displayUsers(users) {
    let html = '';
    if (users.length === 0) {
        html = '<li class="py-2 px-2 text-gray-500 text-center">Keine Benutzer gefunden</li>';
    } else {
        users.forEach(u => {
            html += `<li class='py-2 px-2 rounded hover:bg-blue-100 cursor-pointer' data-id='${u.id}'>${u.firstname} ${u.lastname} <span class='text-xs text-gray-400'>${u.email}</span></li>`;
        });
    }
    $('#user-list').html(html);
}

// Suche nach Usern
$('#user-search').on('input', function() {
    const query = $(this).val();
    if (query.length === 0) {
        // Wenn Suchfeld leer ist, alle Benutzer anzeigen
        loadAllUsers();
    } else {
        // Suche durchführen
        $.post("{{ route('chat.search') }}", {query: query, _token: '{{ csrf_token() }}'}, function(users) {
            displayUsers(users);
        });
    }
});

// User anklicken und Chat laden
$('#user-list').on('click', 'li', function() {
    selectedUserId = $(this).data('id');
    loadMessages();
});

function loadMessages() {
    if (!selectedUserId) return;
    $.post("{{ route('chat.messages') }}", {user_id: selectedUserId, _token: '{{ csrf_token() }}'}, function(messages) {
        let html = '';
        messages.forEach(m => {
            const align = m.sender_id == {{ auth()->id() }} ? 'items-end' : 'items-start';
            const bubble = m.sender_id == {{ auth()->id() }} ? 'bg-blue-600 text-white' : 'bg-blue-100';
            html += `<div class='mb-2 flex flex-col ${align}'>
                <span class='text-xs text-gray-500'>${m.sender_id == {{ auth()->id() }} ? 'Du' : ''}</span>
                <div class='${bubble} rounded px-3 py-2'>${m.message}</div>
            </div>`;
        });
        $('#chat-window').html(html);
        $('#chat-window').scrollTop($('#chat-window')[0].scrollHeight);
    });
}

// Nachricht senden
$('#chat-form').on('submit', function(e) {
    e.preventDefault();
    const msg = $('#chat-message').val();
    if (!msg || !selectedUserId) return;
    $.post("{{ route('chat.send') }}", {receiver_id: selectedUserId, message: msg, _token: '{{ csrf_token() }}'}, function(res) {
        $('#chat-message').val('');
        loadMessages();
    });
});

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
