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

    <h2 class="text-3xl font-bold text-blue-600 mb-2">Kalender</h2>
    <p class="text-gray-600 mb-6">Hier kannst du Termine und Erinnerungen einsehen, neue Einträge erstellen und deinen persönlichen Monatskalender verwalten.</p>
    <div id="calendar" class="bg-white border rounded shadow p-4"></div>
</div>

<!-- Modal für neuen Termin/Erinnerung -->
<div id="eventModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <!-- X Button oben rechts -->
        <button type="button" id="closeModalX" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h3 class="text-lg font-bold mb-4">Neuer Eintrag für <span id="modal-date"></span></h3>
        <form id="eventForm">
            <input type="text" id="eventTitle" class="w-full border border-gray-300 rounded px-3 py-2 mb-3" placeholder="Titel (z.B. Termin, Erinnerung)" required>
            <textarea id="eventDesc" class="w-full border border-gray-300 rounded px-3 py-2 mb-3" placeholder="Beschreibung"></textarea>
            <input type="time" id="eventTime" class="w-full border border-gray-300 rounded px-3 py-2 mb-3" placeholder="Uhrzeit">
            <div class="flex justify-end gap-2">
                <button type="button" id="closeModal" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Abbrechen</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Speichern</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal für Event-Details -->
<div id="eventDetailsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <!-- X Button oben rechts -->
        <button type="button" id="closeDetailsModalX" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h3 class="text-lg font-bold mb-4 text-blue-700">Termin-Details</h3>
        <div class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Titel</label>
                <p id="detailTitle" class="text-gray-900 font-semibold"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Datum</label>
                <p id="detailDate" class="text-gray-900"></p>
            </div>
            <div id="detailTimeContainer" class="hidden">
                <label class="block text-sm font-medium text-gray-700">Uhrzeit</label>
                <p id="detailTime" class="text-gray-900"></p>
            </div>
            <div id="detailDescContainer" class="hidden">
                <label class="block text-sm font-medium text-gray-700">Beschreibung</label>
                <p id="detailDescription" class="text-gray-700"></p>
            </div>
        </div>
        <div class="flex justify-end gap-2 mt-6">
            <button type="button" id="closeDetailsModal" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Schließen</button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'de',
        height: 600,
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        events: async function(fetchInfo, successCallback, failureCallback) {
            try {
                const res = await fetch("{{ route('calendar.events.index') }}");
                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }
                const data = await res.json();
                console.log('Calendar events:', data); // Debug log
                const events = data.map(ev => {
                    let start = ev.date;
                    let title = ev.title;
                    
                    // Handle time formatting
                    if(ev.time && ev.time !== null) {
                        // If time is in HH:MM:SS format, extract HH:MM
                        const timeStr = ev.time.substring(0, 5);
                        start = ev.date.substring(0, 10) + 'T' + ev.time;
                        title += ' (' + timeStr + ' Uhr)';
                    }
                    
                    if(ev.description) {
                        title += ' - ' + ev.description;
                    }
                    
                    return {
                        id: ev.id,
                        title: title,
                        start: start,
                        allDay: !ev.time,
                        extendedProps: {
                            originalTitle: ev.title,
                            description: ev.description,
                            time: ev.time,
                            date: ev.date
                        }
                    };
                });
                console.log('Processed events:', events); // Debug log
                successCallback(events);
            } catch (e) {
                console.error('Error fetching calendar events:', e);
                failureCallback(e);
            }
        },
        dateClick: function(info) {
            document.getElementById('modal-date').textContent = info.dateStr;
            document.getElementById('eventModal').classList.remove('hidden');
            document.getElementById('eventForm').onsubmit = async function(e) {
                e.preventDefault();
                const title = document.getElementById('eventTitle').value;
                const desc = document.getElementById('eventDesc').value;
                const time = document.getElementById('eventTime').value;
                const res = await fetch("{{ route('calendar.events.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        title: title,
                        description: desc,
                        date: info.dateStr,
                        time: time
                    })
                });
                if(res.ok) {
                    calendar.refetchEvents();
                }
                document.getElementById('eventModal').classList.add('hidden');
                document.getElementById('eventForm').reset();
            };
        },
        eventClick: function(info) {
            console.log('Event clicked:', info.event); // Debug log
            
            // Populate the details modal
            document.getElementById('detailTitle').textContent = info.event.extendedProps.originalTitle;
            
            // Format the date nicely
            const eventDate = new Date(info.event.extendedProps.date);
            const formattedDate = eventDate.toLocaleDateString('de-DE', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('detailDate').textContent = formattedDate;
            
            // Show time if available
            if (info.event.extendedProps.time) {
                const timeStr = info.event.extendedProps.time.substring(0, 5);
                document.getElementById('detailTime').textContent = timeStr + ' Uhr';
                document.getElementById('detailTimeContainer').classList.remove('hidden');
            } else {
                document.getElementById('detailTimeContainer').classList.add('hidden');
            }
            
            // Show description if available
            if (info.event.extendedProps.description) {
                document.getElementById('detailDescription').textContent = info.event.extendedProps.description;
                document.getElementById('detailDescContainer').classList.remove('hidden');
            } else {
                document.getElementById('detailDescContainer').classList.add('hidden');
            }
            
            // Show the modal
            document.getElementById('eventDetailsModal').classList.remove('hidden');
        }
    });
    calendar.render();
    
    // Event Listener für beide Close-Buttons
    document.getElementById('closeModal').onclick = function() {
        document.getElementById('eventModal').classList.add('hidden');
        document.getElementById('eventForm').reset();
    };
    
    document.getElementById('closeModalX').onclick = function() {
        document.getElementById('eventModal').classList.add('hidden');
        document.getElementById('eventForm').reset();
    };
    
    // Event Listener für Details-Modal Close-Buttons
    document.getElementById('closeDetailsModal').onclick = function() {
        document.getElementById('eventDetailsModal').classList.add('hidden');
    };
    
    document.getElementById('closeDetailsModalX').onclick = function() {
        document.getElementById('eventDetailsModal').classList.add('hidden');
    };
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
