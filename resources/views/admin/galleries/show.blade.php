@extends('admin.layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ Storage::url('galleries/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">{{ $gallery->title }}</h3>
                            
                            <div class="mb-4">
                                <h4 class="text-lg font-semibold mb-2">Description</h4>
                                <p class="text-gray-600">{{ $gallery->description ?: 'No description available' }}</p>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-lg font-semibold mb-2">Featured</h4>
                                <span class="px-3 py-1 text-sm rounded-full {{ $gallery->is_featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $gallery->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-lg font-semibold mb-2">Status</h4>
                                <span class="px-3 py-1 text-sm rounded-full {{ $gallery->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($gallery->status) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-lg font-semibold mb-2">Created At</h4>
                                <p class="text-gray-600">{{ $gallery->created_at->format('F j, Y H:i:s') }}</p>
                            </div>

                            <div class="mb-4">
                                <h4 class="text-lg font-semibold mb-2">Last Updated</h4>
                                <p class="text-gray-600">{{ $gallery->updated_at->format('F j, Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 