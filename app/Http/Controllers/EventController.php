<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $userBookings = EventBooking::where('user_id', 1)->pluck('event_id')->toArray(); // Mocking user 1
        return view('events.index', compact('events', 'userBookings'));
    }

    public function book(Request $request, Event $event)
    {
        // Check if already booked
        $existing = EventBooking::where('user_id', 1)->where('event_id', $event->id)->first();
        if ($existing) {
            return back()->with('error', 'You have already booked this event.');
        }

        EventBooking::create([
            'user_id' => 1, // Mocking user 1
            'event_id' => $event->id,
            'ticket_id' => (string) Str::uuid(),
            'price_paid' => $event->price,
            'payment_status' => 'paid',
            'booked_at' => now(),
        ]);

        return back()->with('success', 'Event booked successfully! Your QR ticket is ready.');
    }
}
