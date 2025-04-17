<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen">
    <div id="app" class="h-[100%]">
        <nav class="bg-white shadow-sm h-[9%]">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-800 hover:text-indigo-600">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="items-center hidden space-x-6 md:flex">
                        @guest
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Login</a>
                        @endif

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-600">Register</a>
                        @endif
                        @else
                        <div class="relative group">
                            <button
                                class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute right-0 z-50 w-48 mt-2 transition-all bg-white border border-gray-200 rounded-md shadow-md opacity-0 group-hover:opacity-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endguest
                    </div>

                    <!-- Mobile menu toggle -->
                    <div class="md:hidden">
                        <button class="text-gray-600 hover:text-indigo-600 focus:outline-none"
                            @click="menuOpen = !menuOpen">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div class="mt-2 space-y-2 md:hidden" x-show="menuOpen" x-cloak>
                    @guest
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Login</a>
                    @endif
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Register</a>
                    @endif
                    @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="h-[90%]">
            @yield('content')
        </main>
    </div>
</body>

</html>