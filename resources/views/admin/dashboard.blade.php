@extends('admin.layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-semibold mb-6">Admin Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Total Bookings Card -->
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Total Bookings</h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ \App\Models\Booking::count() }}
                        </span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Pending</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\Booking::where('status', 'pending')->count() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Confirmed</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\Booking::where('status', 'confirmed')->count() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Completed</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\Booking::where('status', 'completed')->count() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Users</h3>
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ \App\Models\User::count() }}
                        </span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Total Customers</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\User::where('role', 'user')->count() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Total Admins</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\User::where('role', 'admin')->count() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Services Card -->
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Services</h3>
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ \App\Models\Service::count() }}
                        </span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Active Services</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\Service::where('status', 'active')->count() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Inactive Services</p>
                            <span class="text-sm font-medium text-gray-900">
                                {{ \App\Models\Service::where('status', 'inactive')->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection