

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @include('templates.head')
</head>

<body>
    @include('templates.sidebar')

    <div class="lg:pl-72">
        <div class="sticky top-0 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8 z-20">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" id="open-sidebar">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>

            <!-- Separator -->
            <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true"></div>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <p class="font-semibold leading-6 text-gray-900 my-auto">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
            </div>
        </div>

        <main class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold leading-6 text-blue-700">@yield('title')</h1>

                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>
