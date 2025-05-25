<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Booking Details</h2>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full 
                            @if($booking->status === 'completed') bg-green-100 text-green-800
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                            @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Service Details -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Service Information</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Service</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->service->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->service->duration }} minutes</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Price</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($booking->price, 2) }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Booking Details -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Booking Information</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Booking ID</dt>
                                    <dd class="mt-1 text-sm text-gray-900">#{{ $booking->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->date->format('F j, Y') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Time</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->time->format('h:i A') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->location }}</dd>
                                </div>
                                @if($booking->notes)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Additional Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('bookings.index') }}"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Back to Bookings
                        </a>
                        @if(in_array($booking->status, ['pending', 'confirmed']))
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="inline-block">
                                @csrf
                                @method('POST')
                                <button type="submit" onclick="return confirm('Are you sure you want to cancel this booking?')"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Cancel Booking
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 