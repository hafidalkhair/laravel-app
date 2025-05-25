<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'service']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%')
                    ->orWhere('email', 'like', '%' . $request->user . '%');
            });
        }

        $bookings = $query->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'service']);
        return view('admin.bookings.show', compact('booking'));
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

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update($validated);

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function report()
    {
        $bookings = Booking::with(['user', 'service'])
            ->when(request('start_date'), function ($query) {
                $query->whereDate('date', '>=', request('start_date'));
            })
            ->when(request('end_date'), function ($query) {
                $query->whereDate('date', '<=', request('end_date'));
            })
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->latest()
            ->get();

        return view('admin.reports.bookings', compact('bookings'));
    }

    public function export()
    {
        $bookings = Booking::with(['user', 'service'])->get();
        
        $csvFileName = 'bookings-' . now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$csvFileName\"",
        ];

        $handle = fopen('php://temp', 'w+');
        fputcsv($handle, ['ID', 'User', 'Service', 'Date', 'Time', 'Location', 'Status', 'Price']);

        foreach ($bookings as $booking) {
            fputcsv($handle, [
                $booking->id,
                $booking->user->name,
                $booking->service->name,
                $booking->date->format('Y-m-d'),
                $booking->time->format('H:i'),
                $booking->location,
                $booking->status,
                $booking->price,
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return Response::make($content, 200, $headers);
    }
}
