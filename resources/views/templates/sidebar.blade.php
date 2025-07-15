{{-- <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" id="mobileSidebar">
    <div id="sidebar-backdrop" class="fixed inset-0 bg-gray-900/80 hidden" aria-hidden="true"></div>
    <div id="sidebar" class="fixed inset-0 flex hidden">
        <div class="relative mr-16 flex w-full max-w-xs flex-1">
            <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                <button type="button" class="-m-2.5 p-2.5" id="close-sidebar">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-blue-600 px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=white" alt="OASIS">
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <div class="text-xs font-semibold leading-6 text-blue-200 mt-3">START</div>
                                </li>
                                <li>
                                    <!-- Current: "bg-blue-700 text-white", Default: "text-blue-200 hover:text-white hover:bg-blue-700" -->
                                    <a href="" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6
                                        bg-blue-700 text-white">
                                        <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <div class="text-xs font-semibold leading-6 text-blue-200 mt-3">VERWALTEN
                                    </div>
                                </li>
                                <li>
                                    <a href="/shops" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6
                                                text-blue-200 hover:bg-blue-700 hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-blue-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                        </svg>
                                        Filialen
                                    </a>
                                </li>
                                <li>
                                    <a href="/logs" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6
                                                    text-blue-200 hover:bg-blue-700 hover:text-white">
                                        <svg class="h-6 w-6 shrink-0 text-blue-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"></path>
                                        </svg>
                                        Logs
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="mt-auto flex justify-center items-center">
                            <div class="relative inline-block text-left">
                                <div class="flex items-center gap-x-3 p-2">
                                    <!-- Avatar -->
                                    <!-- Email -->
                                    <p class="group flex gap-x-3 rounded-md text-sm font-semibold leading-6 text-blue-200 hover:text-white">
                                        zbuck@example.com
                                    </p>
                                    <!-- Options Button -->

                                </div>
                                <form method="POST" action="/logout">
                                    <input type="hidden" name="_token" value="DThyUcJEw1hNlhp2aS8me1hIPGp9BJncRUkq87t9" autocomplete="off">                                        <button type="submit" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-blue-900 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset  hover:bg-blue-800" id="logout-button" aria-expanded="false" aria-haspopup="true">
                                        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h6a1 1 0 011 1v4a1 1 0 11-2 0V4H8v12h4v-3a1 1 0 112 0v4a1 1 0 01-1 1H7a1 1 0 01-1-1V3z" clip-rule="evenodd"></path>
                                            <path fill-rule="evenodd" d="M10 12a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div> --}}


<!-- Static sidebar for desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-blue-500 px-6 pb-4">
        <div class="flex h-16 shrink-0 items-center">
            <img class="h-8 w-auto" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=white" alt="Your Company">
        </div>
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <li>
                            <div class="text-xs font-semibold leading-6 text-blue-200 mt-3">ALLGEMEIN</div>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6
                                {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:text-white hover:bg-blue-700' }}">

                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('articles.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6
                                {{ request()->routeIs('articles.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:text-white hover:bg-blue-700' }}">

                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                </svg>
                                News
                            </a>
                        </li>
                        



                        <li>
                            <div class="text-xs font-semibold leading-6 text-blue-200 mt-3">MITARBEITER</div>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('chat.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('chat.index') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:text-white hover:bg-blue-700' }}">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25v-.375A2.625 2.625 0 0110.125 5.25h3.75A2.625 2.625 0 0116.5 7.875v.375m-9 0A2.625 2.625 0 005.25 10.875v3.75A2.625 2.625 0 007.875 17.25h.375m9-9v.375m0 0A2.625 2.625 0 0118.75 10.875v3.75A2.625 2.625 0 0116.125 17.25h-.375m-9-9h9m-9 9h9" />
                                </svg>
                                Chat
                            </a>
                        </li>

                        <li>
                             <a href="{{ route('calendar.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('calendar.index') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:text-white hover:bg-blue-700' }}">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12z" />
                                </svg>
                                Kalender
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('todos.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('todos.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:text-white hover:bg-blue-700' }}">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3-6h.008v.008H21V12m-3.75 0h.008v.008H17.25V12M13.5 9.75h.008v.008H13.5V9.75M9.75 9.75h.008v.008H9.75V9.75M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>
                                To-Do
                            </a>
                        </li>
                        <li>
                             <a href="{{ route('schedule.manage') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-blue-200 hover:bg-blue-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Schichtplanung
                            </a>
                        </li>
                        <li>
                             <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-blue-200 hover:bg-blue-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Knowledge Base
                            </a>
                        </li>
                        <li>
                             <a href="{{ route('instructions.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-blue-200 hover:bg-blue-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                                Unterweisungen
                            </a>
                        </li>
                        <li>
                             <a href="{{ route('trainings.dashboard') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 {{ request()->routeIs('trainings.dashboard') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:text-white hover:bg-blue-700' }}">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Schulungen
                            </a>
                        </li>
                        <li>
                             <a href="{{ route('schedule.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-blue-200 hover:bg-blue-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Schichtplanung
                            </a>
                        </li>
                        <li>
                             <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-blue-200 hover:bg-blue-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                </svg>
                                // Urlaub
                            </a>
                        </li>


                        <li>
                            <div class="text-xs font-semibold leading-6 text-blue-200 mt-3">VERWALTEN - MITARBEITER</div>
                        </li>
                        
                        
                        
                        <li>
                        <!-- Current: "bg-blue-700 text-white", Default: "text-blue-200 hover:text-white hover:bg-blue-700" -->
                        
                        
                        <li>
                             <a href="#" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-blue-200 hover:bg-blue-700 hover:text-white">
                                <svg class="h-6 w-6 shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                                </svg>
                                // Urlaubsscheine freigeben
                            </a>
                        </li>
                        
                        
                
                <li class="mt-auto flex justify-center items-center">
                    <div class="relative inline-block text-left">
                        <div class="flex items-center gap-x-3 p-2">
                            <!-- Avatar -->
                            <!-- Email -->
                            <p class="group flex gap-x-3 rounded-md text-sm font-semibold leading-6 text-blue-200 hover:text-white">
                                {{ auth()->user()->email }}
                            </p>
                            <!-- Options Button -->

                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-blue-900 px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset  hover:bg-blue-800" id="logout-button" aria-expanded="false" aria-haspopup="true">
                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h6a1 1 0 011 1v4a1 1 0 11-2 0V4H8v12h4v-3a1 1 0 112 0v4a1 1 0 01-1 1H7a1 1 0 01-1-1V3z" clip-rule="evenodd"></path>
                                    <path fill-rule="evenodd" d="M10 12a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>

