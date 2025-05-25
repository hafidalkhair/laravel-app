@extends('admin.layouts.app')

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Booking Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($booking->status === 'completed') bg-green-100 text-green-800
                                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                        @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Booking ID</h4>
                                    <p class="mt-1 text-sm text-gray-900">#{{ $booking->id }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Date & Time</h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ $booking->date->format('F j, Y') }} at {{ $booking->time->format('h:i A') }}
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Location</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->location }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Price</h4>
                                    <p class="mt-1 text-sm text-gray-900">${{ number_format($booking->price, 2) }}</p>
                                </div>

                                @if($booking->notes)
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Notes</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</p>
                                </div>
                                @endif

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Created At</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->created_at->format('F j, Y h:i A') }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Last Updated</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $booking->updated_at->format('F j, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Client and Service Information -->
                        <div>
                            <!-- Client Information -->
                            <div class="mb-8">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Name</h4>
                                        <p class="mt-1 text-sm text-gray-900">{{ $booking->user->name }}</p>
                                    </div>

                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Email</h4>
                                        <p class="mt-1 text-sm text-gray-900">{{ $booking->user->email }}</p>
                                    </div>

                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Phone</h4>
                                        <p class="mt-1 text-sm text-gray-900">{{ $booking->user->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Information -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Service Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Service</h4>
                                        <p class="mt-1 text-sm text-gray-900">{{ $booking->service->name }}</p>
                                    </div>

                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Duration</h4>
                                        <p class="mt-1 text-sm text-gray-900">{{ $booking->service->duration }} minutes</p>
                                    </div>

                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                        <p class="mt-1 text-sm text-gray-900">{{ $booking->service->description }}</p>
                                    </div>

                                    @if($booking->service->image)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Service Image</h4>
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($booking->service->image) }}" 
                                                 alt="{{ $booking->service->name }}" 
                                                 class="h-32 w-32 object-cover rounded-lg">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection