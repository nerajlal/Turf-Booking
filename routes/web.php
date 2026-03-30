<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    $firstTurf = \App\Models\Turf::first();
    return view('welcome', compact('firstTurf'));
})->name('home');

Route::get('/turf/{id}', [BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Matchmaking
use App\Http\Controllers\MatchmakingController;
Route::get('/matchmaking', [MatchmakingController::class, 'index'])->name('matchmaking.index');

// Events
Route::get('/events', function() {
    return view('events.index', ['events' => \App\Models\Event::all()]);
})->name('events.index');
