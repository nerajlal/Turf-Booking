<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rateable_id' => 'required|integer',
            'rateable_type' => 'required|string',
            'score' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Rating::create([
            'user_id' => 1, // Mocking user 1
            'rateable_id' => $validated['rateable_id'],
            'rateable_type' => $validated['rateable_type'],
            'score' => $validated['score'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Thank you for your rating!');
    }
}
