<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Book {{ $service->name }}</h2>

                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <!-- Service Summary -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Service Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Service</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $service->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $service->duration }} minutes</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Price</dt>
                                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($service->price, 2) }}</dd>
                                </div>
                            </div>
                        </div>

                        <!-- Date and Time -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Select Date and Time</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" id="date" required
                                        min="{{ date('Y-m-d') }}"
                                        value="{{ old('date') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    @error('date')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <input type="time" name="time" id="time" required
                                        value="{{ old('time') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    @error('time')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Location Details</h3>
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" id="location" required
                                    value="{{ old('location') }}"
                                    placeholder="Enter the full address"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                @error('location')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                                <textarea name="notes" id="notes" rows="4"
                                    placeholder="Any special requests or additional information"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('services.show', $service) }}"
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Book Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 