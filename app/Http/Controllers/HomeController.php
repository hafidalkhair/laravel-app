<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $featuredGalleries = Gallery::where('status', 'active')
            ->where('is_featured', true)
            ->latest()
            ->take(5)
            ->get();

        // Debug info
        Log::info('Featured Galleries:', [
            'count' => $featuredGalleries->count(),
            'data' => $featuredGalleries->toArray()
        ]);

        $services = Service::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredGalleries', 'services'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        
        $recentBookings = $user->bookings()
            ->with('service')
            ->latest()
            ->take(5)
            ->get();

        $upcomingBookings = $user->bookings()
            ->with('service')
            ->where('date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('date')
            ->take(3)
            ->get();

        $services = Service::where('status', 'active')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'recentBookings',
            'upcomingBookings',
            'services'
        ));
    }
}
