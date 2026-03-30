<?php

namespace App\Http\Controllers;

use App\Models\Turf;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $turf = Turf::active()->first() ?? Turf::first();
        
        if (!$turf) {
            return "Please run 'php artisan db:seed' to create the master turf.";
        }

        return view('welcome', compact('turf'));
    }
}
