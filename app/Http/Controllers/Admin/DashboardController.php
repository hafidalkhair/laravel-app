<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_services' => Service::count(),
            'total_bookings' => Booking::count(),
            'revenue' => Booking::where('status', 'completed')->sum('price'),
        ];

        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        $monthlyRevenue = Booking::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(price) as total')
            )
            ->groupBy('month')
            ->get();

        $bookingsByStatus = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentBookings',
            'monthlyRevenue',
            'bookingsByStatus'
        ));
    }
}
