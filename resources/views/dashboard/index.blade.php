@extends('templates.layout')

@section('content')
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Erfolg</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
@endsection
