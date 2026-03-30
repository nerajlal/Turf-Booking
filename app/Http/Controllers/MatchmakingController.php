<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MatchInvitation;
use Illuminate\Http\Request;

class MatchmakingController extends Controller
{
    public function index()
    {
        // For simulation, we'll just return a list of "Playpals"
        // In a real app, this would filter by sport, skill level, and location
        $playpals = User::where('id', '!=', 1)->limit(10)->get();
        
        return view('matchmaking.index', compact('playpals'));
    }

    public function invite(Request $request, User $receiver)
    {
        // Mocking sender as user 1
        $senderId = 1;

        if ($senderId == $receiver->id) {
            return response()->json(['error' => 'You cannot invite yourself.'], 400);
        }

        $invitation = MatchInvitation::updateOrCreate(
            ['sender_id' => $senderId, 'receiver_id' => $receiver->id],
            ['sport' => $request->sport ?? 'Football', 'status' => 'pending']
        );

        return response()->json(['success' => 'Invitation sent to ' . $receiver->name]);
    }
}
