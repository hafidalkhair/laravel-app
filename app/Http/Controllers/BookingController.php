<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with('service')
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $service = Service::findOrFail($request->service);
        return view('bookings.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $service = Service::findOrFail($request->service_id);
        
        $booking = auth()->user()->bookings()->create([
            'service_id' => $service->id,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'notes' => $validated['notes'],
            'price' => $service->price,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully! We will confirm your booking soon.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('service');
        
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('update', $booking);

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
