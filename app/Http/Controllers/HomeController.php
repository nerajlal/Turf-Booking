<?php

namespace App\Http\Controllers;

use App\Models\Turf;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Turf::query()->active();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('sport')) {
            // Assuming we add a 'sport' column or use tags/description
            $query->where('description', 'LIKE', '%' . $request->sport . '%');
        }

        if ($request->filled('max_price')) {
            $query->filterByPrice($request->max_price);
        }

        $turfs = $query->latest()->paginate(12);
        $firstTurf = $turfs->first();

        return view('welcome', compact('turfs', 'firstTurf'));
    }
}
