<?php

namespace App\Http\Controllers;

use App\Models\Turf;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

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
        $start = $request->start; // FullCalendar sends start/end dates
        $end = $request->end;
        
        $bookings = Booking::where('turf_id', $turfId)
            ->whereBetween('booking_date', [Carbon::parse($start)->toDateString(), Carbon::parse($end)->toDateString()])
            ->get(['start_time', 'end_time', 'booking_date']);

        $events = $bookings->map(function($booking) {
            return [
                'title' => 'Booked',
                'start' => $booking->booking_date . 'T' . $booking->start_time,
                'end' => $booking->booking_date . 'T' . $booking->end_time,
                'backgroundColor' => '#f3f4f6',
                'borderColor' => '#e5e7eb',
                'textColor' => '#9ca3af',
                'display' => 'background', // Show as background to prevent selection
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'turf_id' => 'required|exists:turfs,id',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'slots' => 'required|array',
            'total_price' => 'required|numeric',
            'participants_count' => 'integer|min:1',
        ]);

        $turfId = $validated['turf_id'];
        $date = $validated['booking_date'];
        $slots = $validated['slots'];
        $participantsCount = $validated['participants_count'] ?? 1;
        $totalPrice = $validated['total_price'];
        $pricePerPerson = $totalPrice / $participantsCount;

        DB::beginTransaction();
        try {
            // Check availability and create bookings
            foreach ($slots as $startTime) {
                $exists = Booking::where('turf_id', $turfId)
                    ->where('booking_date', $date)
                    ->where('start_time', $startTime)
                    ->exists();

                if ($exists) {
                    throw new \Exception("Slot $startTime is already booked.");
                }

                Booking::create([
                    'turf_id' => $turfId,
                    'user_id' => $validated['user_id'],
                    'booking_date' => $date,
                    'start_time' => $startTime,
                    'end_time' => $this->addOneHour($startTime),
                    'total_price' => $totalPrice / count($slots),
                    'participants_count' => $participantsCount,
                    'price_per_person' => $pricePerPerson / count($slots),
                    'payment_status' => $participantsCount > 1 ? 'split_pending' : 'paid',
                ]);
            }

            // Stripe Integration (Simplified for now, using Session)
            // Stripe::setApiKey(env('STRIPE_SECRET'));
            // Logic to create Checkout Session would go here...

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $participantsCount > 1 
                    ? "Booking initiated! Split payment of £" . number_format($pricePerPerson, 2) . " per person generated."
                    : 'Booking successful!',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    private function addOneHour($time)
    {
        return Carbon::parse($time)->addHour()->format('H:i');
    }
}
