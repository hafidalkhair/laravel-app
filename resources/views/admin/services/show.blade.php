@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Service Details</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.services.edit', $service) }}"
                class="bg-primary hover:bg-blue-700 text-white px-4 py-2 rounded">
                Edit Service
            </a>
            <a href="{{ route('admin.services.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to Services
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Service Image -->
                <div class="md:col-span-2">
                    @if($service->image)
                    <div class="mb-4">
                        <img src="{{ Storage::url($service->image) }}"
                            alt="{{ $service->name }}"
                            class="w-full max-w-md h-64 object-cover rounded-lg mx-auto">
                    </div>
                    @endif
                </div>

                <!-- Service Information -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Service Information</h3>
                        <div class="mt-2 space-y-2">
                            <div>
                                <span class="text-gray-500">Name:</span>
                                <span class="ml-2 text-gray-900">{{ $service->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Price:</span>
                                <span class="ml-2 text-gray-900">${{ number_format($service->price, 2) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Duration:</span>
                                <span class="ml-2 text-gray-900">{{ $service->duration }} minutes</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span class="ml-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $service->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($service->status) }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Description -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-600 whitespace-pre-line">{{ $service->description }}</p>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-medium text-red-600 mb-4">Danger Zone</h3>
                <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this service? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Delete Service
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 