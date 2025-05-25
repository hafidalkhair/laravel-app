<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins antialiased">
    <x-guest-layout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
            <div>
                <a href="{{ route('home') }}" class="text-white text-lg font-bold hover:text-gray-300">
                    ← Back to Website
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Admin Panel</h2>
                    <p class="mt-2 text-sm text-gray-400">Sign in to manage your website</p>
                </div>

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input type="password" name="password" id="password" required
                            class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input type="checkbox" name="remember" id="remember_me"
                                class="rounded border-gray-600 bg-gray-700 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-300">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Login to Admin Panel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-guest-layout>
</body>
</html> 