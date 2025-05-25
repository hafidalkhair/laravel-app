@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Service</h1>
        <a href="{{ route('admin.services.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Back to Services
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Service Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                        <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" step="0.01" required
                            class="w-full pl-8 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration (minutes)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $service->duration) }}" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                        <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Service Image</label>
                    @if($service->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="h-32 w-32 object-cover rounded">
                    </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500">Leave empty to keep the current image. Accepted formats: JPEG, PNG, JPG. Max size: 2MB</p>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="bg-primary hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                    Update Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 