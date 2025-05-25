<x-app-layout>
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Our Gallery
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Explore our collection of beautiful moments captured through our lens.
            </p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($galleries as $gallery)
            <div class="group relative">
                <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                    <img src="{{ Storage::url('galleries/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-full object-center object-cover">
                </div>
                <h3 class="mt-6 text-sm text-gray-500">
                    <span class="absolute inset-0"></span>
                    {{ $gallery->title }}
                </h3>
                <p class="text-base font-semibold text-gray-900">{{ Str::limit($gallery->description, 100) }}</p>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
</x-app-layout> 