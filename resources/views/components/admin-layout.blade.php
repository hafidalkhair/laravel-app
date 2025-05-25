@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - ' : '' }}Admin Panel - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Admin Navigation -->
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-xl">
                                Admin Panel
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('admin.services.index') }}" 
                               class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.services.*') ? 'bg-gray-900' : '' }}">
                                Services
                            </a>
                            <a href="{{ route('admin.bookings.index') }}" 
                               class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-900' : '' }}">
                                Bookings
                            </a>
                            <a href="{{ route('admin.users.index') }}" 
                               class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : '' }}">
                                Users
                            </a>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('home')" class="text-gray-700">
                                        {{ __('View Site') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('profile.edit')" class="text-gray-700">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="text-gray-700">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden" x-show="open">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.services.index') }}" 
                       class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.services.*') ? 'bg-gray-900' : '' }}">
                        Services
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" 
                       class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-900' : '' }}">
                        Bookings
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="text-gray-300 hover:text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : '' }}">
                        Users
                    </a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 border-t border-gray-700">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-sm text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }} Admin Panel. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>
</html> 