<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Reset Password') }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Please enter your new password') }}
                </p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">
                        {{ __('Whoops! Something went wrong.') }}
                    </div>

                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">
                        {{ __('Email') }}
                    </label>

                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">
                        {{ __('Password') }}
                    </label>

                    <input id="password" type="password" name="password" required
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                        {{ __('Confirm Password') }}
                    </label>

                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 