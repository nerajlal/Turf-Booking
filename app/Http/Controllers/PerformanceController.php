<?php

namespace App\Http\Controllers;

use App\Models\PerformanceLog;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $logs = PerformanceLog::where('user_id', 1)->latest()->paginate(20); // Mocking user 1
        return view('performance.index', compact('logs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'metric' => 'required|string',
            'value' => 'required|numeric',
            'unit' => 'required|string',
            'logged_at' => 'required|date',
        ]);

        PerformanceLog::create([
            'user_id' => 1, // Mocking user 1
            'metric' => $validated['metric'],
            'value' => $validated['value'],
            'unit' => $validated['unit'],
            'logged_at' => $validated['logged_at'],
        ]);

        return back()->with('success', 'Performance metric logged successfully!');
    }
}
