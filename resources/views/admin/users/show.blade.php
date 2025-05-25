<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
            <form action="{{ route('admin.users.destroy', $user) }}" 
                  method="POST" 
                  class="inline-block"
                  onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Delete User
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- User Information -->
                <div class="col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">User Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Name</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Email</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Phone</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->phone }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Joined Date</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F j, Y') }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Last Updated</h4>
                                    <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg mt-6">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Statistics</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Total Bookings</h4>
                                    <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $user->bookings_count }}</p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Completed Bookings</h4>
                                    <p class="mt-1 text-2xl font-semibold text-green-600">
                                        {{ $user->bookings->where('status', 'completed')->count() }}
                                    </p>
                                </div>

                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Total Spent</h4>
                                    <p class="mt-1 text-2xl font-semibold text-primary">
                                        ${{ number_format($user->bookings->sum('price'), 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bookings History -->
                <div class="col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Booking History</h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($user->bookings()->latest()->get() as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $booking->service->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->service->duration }} minutes</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $booking->date->format('M d, Y') }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->time->format('H:i A') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($booking->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                                    @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($booking->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.bookings.show', $booking) }}" 
                                                   class="text-primary hover:text-blue-900">View</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                No bookings found for this user.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> 