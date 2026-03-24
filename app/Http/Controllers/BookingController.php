<?php

namespace App\Http\Controllers;

use App\Models\Turf;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index($id)
    {
        $turf = Turf::findOrFail($id);
        return view('bookings.index', compact('turf'));
    }

    public function getSlots(Request $request)
    {
        $turfId = $request->turf_id;
        $date = $request->date;
        
        $bookings = Booking::where('turf_id', $turfId)
            ->where('booking_date', $date)
            ->get(['start_time', 'end_time']);

        $bookedSlots = $bookings->map(function($booking) {
            return Carbon::parse($booking->start_time)->format('H:i');
        })->toArray();

        $sections = [
            'Morning' => ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00'],
            'Afternoon' => ['12:00', '13:00', '14:00', '15:00'],
            'Evening' => ['16:00', '17:00', '18:00', '19:00'],
            'Night' => ['20:00', '21:00', '22:00', '23:00'],
        ];

        $slots = [];
        foreach ($sections as $sectionName => $times) {
            foreach ($times as $time) {
                $isBooked = in_array($time, $bookedSlots);
                $isFastFilling = !$isBooked && rand(0, 10) > 7; // Mock "Fast Filling" logic

                $slots[] = [
                    'time' => $time,
                    'section' => $sectionName,
                    'status' => $isBooked ? 'booked' : 'available',
                    'fast_filling' => $isFastFilling
                ];
            }
        }

        return response()->json($slots);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'turf_id' => 'required|exists:turfs,id',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_price' => 'required|numeric',
        ]);

        $booking = Booking::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Booking successful!',
            'booking' => $booking
        ]);
    }
}
