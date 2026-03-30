<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        $query = Trainer::query()->active();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('specialization')) {
            $query->where('specialization', 'LIKE', '%' . $request->specialization . '%');
        }

        if ($request->filled('max_rate')) {
            $query->filterByRate($request->max_rate);
        }

        $trainers = $query->latest()->paginate(12);

        return view('trainers.index', compact('trainers'));
    }

    public function show(Trainer $trainer)
    {
        return view('trainers.show', compact('trainer'));
    }

    public function book(Request $request, Trainer $trainer)
    {
        // Simple booking logic for trainers
        return back()->with('success', 'Request sent to ' . $trainer->name . '! They will contact you shortly.');
    }
}
