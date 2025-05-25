<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Upcoming Bookings Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Upcoming Bookings</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ auth()->user()->bookings()->where('status', 'confirmed')->count() }}</span>
                            </div>
                            <div class="space-y-3">
                                @foreach(auth()->user()->bookings()->where('status', 'confirmed')->latest()->take(3)->get() as $booking)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $booking->service->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $booking->date->format('d M Y') }} at {{ $booking->time->format('H:i') }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                            <a href="{{ route('bookings.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                View all bookings
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Services Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Available Services</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ \App\Models\Service::where('status', 'active')->count() }}</span>
                            </div>
                            <div class="space-y-3">
                                @foreach(\App\Models\Service::where('status', 'active')->take(3)->get() as $service)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $service->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $service->duration }} • Rp {{ number_format($service->price, 2) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <a href="{{ route('services.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                                View all services
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('services.index') }}" class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">Book a Service</span>
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">Edit Profile</span>
                                </a>
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-base font-medium text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">Admin Dashboard</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 