<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function findPlaypals(Request $request)
    {
        $sport = $request->sport;
        $skillLevel = $request->skill_level;

        // Mock search logic
        $playpals = User::where('id', '!=', 1)
            ->when($sport, function($query) use ($sport) {
                // In real app, user would have many-to-many sports
                return $query;
            })
            ->get();

        return response()->json($playpals);
    }
}
