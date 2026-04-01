<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/turf/{id}', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/api/slots', [BookingController::class, 'getSlots'])->name('bookings.slots');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Matchmaking
use App\Http\Controllers\MatchmakingController;
Route::get('/matchmaking', [MatchmakingController::class, 'index'])->name('matchmaking.index');
Route::post('/matchmaking/invite/{receiver}', [MatchmakingController::class, 'invite'])->name('matchmaking.invite');

// Trainers
use App\Http\Controllers\TrainerController;
Route::get('/trainers', [TrainerController::class, 'index'])->name('trainers.index');
Route::get('/trainers/{trainer}', [TrainerController::class, 'show'])->name('trainers.show');
Route::post('/trainers/book/{trainer}', [TrainerController::class, 'book'])->name('trainers.book');

// Ratings
use App\Http\Controllers\RatingController;
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// Performance Tracking
use App\Http\Controllers\PerformanceController;
Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
Route::post('/performance', [PerformanceController::class, 'store'])->name('performance.store');

// Events
use App\Http\Controllers\EventController;
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::post('/events/book/{event}', [EventController::class, 'book'])->name('events.book');
