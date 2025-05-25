<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Service Header -->
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="flex-1 min-w-0">
                            <nav class="flex" aria-label="Breadcrumb">
                                <ol role="list" class="flex items-center space-x-4">
                                    <li>
                                        <div class="flex items-center">
                                            <a href="{{ route('services.index') }}" class="text-sm font-medium text-primary hover:text-blue-700">Services</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                            </svg>
                                            <span class="ml-4 text-sm font-medium text-gray-500">{{ $service->name }}</span>
                                        </div>
                                    </li>
                                </ol>
                            </nav>
                            <h2 class="mt-4 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">{{ $service->name }}</h2>
                        </div>
                        <div class="mt-5 flex lg:mt-0 lg:ml-4">
                            <span class="sm:ml-3">
                                <a href="{{ route('bookings.create', ['service' => $service->id]) }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Book Now
                                </a>
                            </span>
                        </div>
                    </div>

                    <!-- Service Content -->
                    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Service Image -->
                        <div>
                            @if($service->image)
                                <img class="w-full h-96 object-cover rounded-lg" src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Service Details -->
                        <div>
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Service Details</h3>
                                    <div class="mt-2 flex items-center text-sm text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $service->duration }} minutes
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        ${{ number_format($service->price, 2) }}
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Description</h3>
                                    <div class="mt-2 prose prose-sm text-gray-500">
                                        {{ $service->description }}
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">What's Included</h3>
                                    <div class="mt-4">
                                        <ul role="list" class="list-disc pl-4 space-y-2 text-sm text-gray-500">
                                            <li>Professional photography session</li>
                                            <li>High-resolution digital images</li>
                                            <li>Basic photo editing and retouching</li>
                                            <li>Online gallery for easy sharing</li>
                                            <li>Print release rights</li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Additional Information</h3>
                                    <div class="mt-4">
                                        <ul role="list" class="list-disc pl-4 space-y-2 text-sm text-gray-500">
                                            <li>Location can be at your preferred venue or our studio</li>
                                            <li>Additional hours available upon request</li>
                                            <li>Props and special equipment included</li>
                                            <li>Rescheduling available with 48 hours notice</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="pt-6">
                                    <a href="{{ route('bookings.create', ['service' => $service->id]) }}"
                                        class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Book This Service
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 