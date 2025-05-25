<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Logo -->
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Welcome Back!') }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Please sign in to your account') }}
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <div class="text-sm">
                        @if (Route::has('password.request'))
                            <a class="text-primary hover:text-blue-700 underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('register') }}" class="text-primary hover:text-blue-700 underline">
                            {{ __('Need an account?') }}
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full justify-center">
                        {{ __('Sign in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout> 