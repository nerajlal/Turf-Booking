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
    public function index()
    {
        $turf = Turf::active()->first() ?? Turf::first();
        if (!$turf) {
            abort(404, 'Turf not found. Please run seeder.');
        }
        return view('bookings.index', compact('turf'));
    }

    public function getSlots(Request $request)
    {
        $turfId = $request->turf_id;
        $date = $request->date;
        $turf = Turf::findOrFail($turfId);

        $bookings = Booking::where('turf_id', $turfId)
            ->where('booking_date', $date)
            ->pluck('start_time')
            ->toArray();

        $slots = [];
        $startHour = (int) explode(':', $turf->opening_hours ?? '07:00')[0];
        $endHour = (int) explode(':', $turf->closing_hours ?? '23:00')[0];

        for ($h = $startHour; $h < $endHour; $h++) {
            $time = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
            $section = $this->getSection($h);
            
            $slots[] = [
                'time' => $time,
                'section' => $section,
                'status' => in_array($time, $bookings) ? 'booked' : 'available',
                'fast_filling' => rand(0, 10) > 8, // Just for UI demo
            ];
        }

        return response()->json($slots);
    }

    private function getSection($hour)
    {
        if ($hour < 12) return 'Morning';
        if ($hour < 17) return 'Afternoon';
        if ($hour < 20) return 'Evening';
        return 'Night';
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'turf_id' => 'exists:turfs,id',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'required|date',
            'slots' => 'required|array',
            'total_price' => 'required|numeric',
            'participants_count' => 'integer|min:1',
        ]);

        $turfId = $validated['turf_id'] ?? (Turf::active()->first()->id ?? Turf::first()->id);
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
