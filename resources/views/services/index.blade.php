<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="md:flex md:items-center md:justify-between mb-6">
                <div class="flex-1 min-w-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Photography Services</h2>
                    <p class="mt-2 text-lg text-gray-500">Choose from our professional photography services</p>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('services.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Search services..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                            <select name="sort" id="sort"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="duration" {{ request('sort') === 'duration' ? 'selected' : '' }}>Duration</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($services as $service)
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    @if($service->image)
                        <img class="h-48 w-full object-cover" src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}">
                    @else
                        <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $service->name }}</h3>
                        <p class="mt-2 text-gray-500">{{ Str::limit($service->description, 150) }}</p>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-lg font-medium text-primary">${{ number_format($service->price, 2) }}</span>
                            <span class="text-sm text-gray-500">{{ $service->duration }} minutes</span>
                        </div>

                        <div class="mt-6 space-y-2">
                            <a href="{{ route('services.show', $service) }}"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                View Details
                            </a>
                            <a href="{{ route('bookings.create', ['service' => $service->id]) }}"
                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-primary rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-primary focus:ring ring-primary ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No services found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 