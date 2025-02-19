@extends('templates.layout')

@section('title', 'Neue Unterweisung erstellen')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-end mb-4">
                <a href="{{ route('all_instructions.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Zurück zu den Unterweisungen</a>
            </div>
        <h1 class="text-2xl font-bold mb-4">Neue Unterweisung erstellen</h1>
        <form action="{{ route('all_instructions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <ul class="flex border-b">
                    <li class="-mb-px mr-1">
                        <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#general">Allgemein</a>
                    </li>
                    <li class="mr-1">
                        <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#settings">Einstellungen</a>
                    </li>
                </ul>
            </div>
            <div id="general" class="tab-content">
                <div class="mb-4">
                    <label for="topic" class="block text-gray-700">Thema:</label>
                    <input type="text" id="topic" name="topic" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label for="company" class="block text-gray-700">Unternehmen:</label>
                    <input type="text" id="company" name="company" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label for="pdf" class="block text-gray-700">PDF:</label>
                    <input type="file" id="pdf" name="pdf" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label for="user" class="block text-gray-700">Benutzer zuweisen:</label>
                    <select id="user" name="user" class="border rounded w-full py-2 px-3">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="settings" class="tab-content hidden">
                <div class="mb-4">
                <label for="user" class="block text-gray-700">Gültigkeit:</label>
                    <input type="date" id="validity" name="validity" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="reminder_send" class="block text-gray-700">Erinnerungen senden Ablauf:</label>
                    <input type="date" id="reminder_send" name="reminder_send" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="grace_period" class="block text-gray-700">Karenzzeit:</label>
                    <input type="number" id="grace_period" name="grace_period" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="end_recipient" class="block text-gray-700">End-Empfänger:</label>
                    <input type="text" id="end_recipient" name="end_recipient" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="confirmation_by_trainee" class="block text-gray-700">Bestätigung durch Azubi:</label>
                    <input type="text" id="confirmation_by_trainee" name="confirmation_by_trainee" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="reminder_send_to" class="block text-gray-700">Erinnerung senden an:</label>
                    <input type="text" id="reminder_send_to" name="reminder_send_to" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="workflow" class="block text-gray-700">Workflow:</label>
                    <input type="text" id="workflow" name="workflow" class="border rounded w-full py-2 px-3">
                </div>
                <div class="mb-4">
                    <label for="confirmed_by" class="block text-gray-700">Wird bestätigt durch:</label>
                    <input type="text" id="confirmed_by" name="confirmed_by" class="border rounded w-full py-2 px-3">
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Erstellen</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.tab-content');
            const tabLinks = document.querySelectorAll('ul.flex a');

            tabLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));

                    tabs.forEach(tab => tab.classList.add('hidden'));
                    target.classList.remove('hidden');

                    tabLinks.forEach(link => link.classList.remove('border-l', 'border-t', 'border-r', 'rounded-t', 'text-blue-700'));
                    this.classList.add('border-l', 'border-t', 'border-r', 'rounded-t', 'text-blue-700');
                });
            });
        });
    </script>
@endsection
