<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // 1. Show the Booking Page (Matches Screenshot 1)
    public function create($court_id)
    {
        $court = Court::findOrFail($court_id);
        return view('bookings.create', compact('court'));
    }

    // 2. The Booking Engine (Logic)
    public function store(Request $request, $court_id)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'date' => 'required|date',
            'time' => 'required', // start time
            'payment_method' => 'required'
        ]);

        $start_time = Carbon::parse($request->time);
        $end_time = $start_time->copy()->addHour(); // Default 1 hour booking

        // --- DOUBLE BOOKING CHECK ---
        $exists = Booking::where('court_id', $court_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where('start_time', '<', $end_time)
                      ->where('end_time', '>', $start_time);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors(['time' => 'This time slot is already booked!']);
        }

        // Create the booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'court_id' => $court_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date' => $request->date,
            'start_time' => $start_time->format('H:i'),
            'end_time' => $end_time->format('H:i'),
            'payment_method' => $request->payment_method,
            'total_amount' => 150.00, // Hardcoded RM 150 based on receipt, or fetch from Court price
            'status' => 'Pending'
        ]);

        // Redirect to the Confirmation Page
        return redirect()->route('bookings.show', $booking->id);
    }

    // 3. Show the Receipt (Matches Screenshot 2)
    public function show($id)
    {
        $booking = Booking::with('court')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }
}
