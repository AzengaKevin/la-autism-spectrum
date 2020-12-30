<nav class="bg-teal-800 shadow" x-data="{ menuOpen: false, dropdownOpen : false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button @click="menuOpen = !menuOpen"
                    class="inline-flex items-center justify-center p-2 rounded-md text-teal-400 hover:text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!menuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="menuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                    <x-jet-application-mark class="h-10 w-10" />
                    <h1 class="text-white font-bold text-2xl hidden sm:block">
                        {{ config('app.name', 'Autism Spectrum') }}</h1>
                </a>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="{{ route('questionnaires.index') }}"
                            class="bg-teal-900 text-white px-3 py-2 rounded-md text-sm font-medium">Questionnaires</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                @guest
                <a href="{{ route('login') }}"
                    class="p-1 rounded-full text-teal-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-800 focus:ring-white">
                    <span class="sr-only">Login</span>
                    <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                        <defs />
                        <path fill="none" d="M-1-1h582v402H-1z" />
                        <g>
                            <path fill="#ccc"
                                d="M32 55.9C18.8 55.9 8.1 45.2 8.1 32S18.8 8.1 32 8.1 55.9 18.8 55.9 32 45.2 55.9 32 55.9zm0-45.2c-11.7 0-21.3 9.6-21.3 21.3 0 11.7 9.6 21.3 21.3 21.3 11.7 0 21.3-9.6 21.3-21.3 0-11.7-9.6-21.3-21.3-21.3z"
                                class="st0" />
                            <path fill="#ccc"
                                d="M18 49.3l-2.4-1.1c.7-1.7 2.9-2.6 5.4-3.7 2.4-1.1 5.4-2.4 5.4-4v-2.2c-.9-.7-2.3-2.3-2.5-4.6-.7-.7-1.8-2-1.8-3.6 0-1 .4-1.8.7-2.3-.2-1.1-.6-3.3-.6-5 0-5.5 3.8-9.1 9.8-9.1 1.7 0 3.8.5 4.9 1.7 2.7.5 4.9 3.7 4.9 7.4 0 2.4-.4 4.4-.7 5.3.3.5.6 1.2.6 2 0 1.9-.9 3.1-1.8 3.7-.2 2.3-1.5 3.8-2.3 4.5v2.2c0 1.4 2.5 2.3 4.8 3.2 2.7 1 5.5 2 6.4 4.3l-2.5.9c-.4-1.2-2.8-2-4.8-2.8-3.1-1.1-6.6-2.4-6.6-5.6v-3.6l.6-.4c.1 0 1.8-1.2 1.8-3.5v-.9l.8-.3c.1-.1.9-.5.9-1.7 0-.4-.3-.8-.4-.9l-.5-.6.2-.7s.7-2.2.7-5.2c0-2.5-1.4-4.8-2.9-4.8h-.8l-.4-.7c-.3-.5-1.5-1-3.1-1-4.5 0-7.2 2.4-7.2 6.5 0 1.9.7 5 .7 5l.2.7-.5.5s-.4.5-.4 1c0 .7.9 1.6 1.3 2l.5.4v.7c0 2.2 1.9 3.4 1.9 3.4l.6.4v3.6c0 3.3-3.7 5-7 6.4-1.4.8-3.5 1.8-3.9 2.5"
                                class="st0" />
                        </g>
                    </svg>
                </a>
                @else
                <div class="ml-3 relative">
                    <div>
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-800 focus:ring-white"
                            id="user-menu" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </div>
                    <div x-show="dropdownOpen"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 text-sm text-teal-700 hover:bg-teal-100"
                            role="menuitem">Dashboard</a>
                        <a href="{{ route('settings.show') }}"
                            class="block px-4 py-2 text-sm text-teal-700 hover:bg-teal-100" role="menuitem">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </div>
                </div>
                @endguest

            </div>
        </div>
    </div>

    <div x-show="menuOpen" class="sm:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('questionnaires.index') }}"
                class="bg-teal-900 text-white block px-3 py-2 rounded-md text-base font-medium">Questionnaires</a>
        </div>
    </div>
</nav>