@extends('layouts.app')

@section('styles')
<style>
    /* Date Selector */
    .date-scroller {
        display: flex;
        overflow-x: auto;
        gap: 12px;
        padding: 10px 0;
        scrollbar-width: none;
    }
    .date-scroller::-webkit-scrollbar {
        display: none;
    }
    .date-item {
        min-width: 80px;
        height: 90px;
        padding: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 16px;
        border: 1px solid var(--glass-border);
    }
    .date-item.active {
        background: var(--accent-color);
        border-color: var(--accent-color);
        box-shadow: 0 0 15px var(--accent-glow);
        transform: scale(1.05);
    }
    .date-item.active .date-day,
    .date-item.active .date-num {
        color: var(--bg-color);
    }
    .date-day {
        font-size: 0.75rem;
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 4px;
    }
    .date-num {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Slot Grid */
    .slot-badge {
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--accent-color);
        color: var(--accent-color);
        background: transparent;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .slot-badge:hover:not(.booked) {
        background: rgba(16, 185, 129, 0.1);
        transform: translateY(-2px);
    }
    .slot-badge.selected {
        background: var(--accent-color);
        color: var(--bg-color);
        box-shadow: 0 0 15px var(--accent-glow);
    }
    .slot-badge.booked {
        border-color: var(--booked-bg);
        color: var(--text-secondary);
        background: var(--booked-bg);
        text-decoration: line-through;
        opacity: 0.5;
        cursor: not-allowed;
    }
    .slot-badge .badge-icon {
        display: none;
        margin-right: 5px;
    }
    .slot-badge.booked .badge-icon {
        display: inline-block;
    }

    /* Pricing Floating Footer */
    .booking-footer {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 600px;
        z-index: 1000;
        background: rgba(15, 23, 42, 0.9);
        display: none;
        align-items: center;
        justify-content: space-between;
        padding: 20px 30px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Turf Details (Left) -->
        <div class="col-lg-4 mb-4">
            <div class="glass-card p-4 h-100">
                <img src="{{ $turf->images[0] }}" class="img-fluid rounded-4 mb-3" alt="{{ $turf->name }}">
                <h2 class="h4 fw-bold">{{ $turf->name }}</h2>
                <p class="text-secondary small">
                    <i class="fa-solid fa-location-dot me-2"></i>{{ $turf->location }}
                </p>
                <div class="d-flex align-items-baseline mb-3">
                    <span class="fs-3 fw-bold text-accent">${{ number_format($turf->price_per_hour, 2) }}</span>
                    <span class="text-secondary ms-2 small">/ hour</span>
                </div>
                <hr class="border-secondary opacity-25">
                <h6 class="text-uppercase small fw-bold text-secondary mb-2">Amenities</h6>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-secondary bg-opacity-10 py-2 px-3">Floodlights</span>
                    <span class="badge bg-secondary bg-opacity-10 py-2 px-3">Locker</span>
                    <span class="badge bg-secondary bg-opacity-10 py-2 px-3">Parking</span>
                </div>
                <button class="btn border-secondary text-secondary w-100 py-3 rounded-3 small">
                    View Details
                </button>
            </div>
        </div>

        <!-- Booking System (Right) -->
        <div class="col-lg-8">
            <div class="glass-card p-4 mb-4">
                <h6 class="section-header">1. Select Date</h6>
                <div class="date-scroller" id="dateScroller">
                    @for($i = 0; $i < 14; $i++)
                        @php
                            $date = \Carbon\Carbon::now()->addDays($i);
                        @endphp
                        <div class="date-item {{ $i == 0 ? 'active' : '' }}" data-date="{{ $date->toDateString() }}">
                            <span class="date-day">{{ $date->format('D') }}</span>
                            <span class="date-num">{{ $date->format('d') }}</span>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="glass-card p-4">
                <h6 class="section-header">2. Available Slots</h6>
                <div id="slotContainer">
                    <!-- Dynamic Slots will be injected here -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Booking Footer -->
<div class="booking-footer glass-card shadow-lg" id="bookingFooter">
    <div>
        <p class="mb-0 text-secondary small" id="selectedCountText">0 Slots Selected</p>
        <h4 class="mb-0 fw-bold" id="totalPriceText">$0.00</h4>
    </div>
    <button class="premium-btn px-5" id="confirmBookingBtn">
        Book Now <i class="fa-solid fa-arrow-right ms-2"></i>
    </button>
</div>

@endsection

@section('scripts')
<script>
    const TURF_ID = {{ $turf->id }};
    const PRICE_PER_HOUR = {{ $turf->price_per_hour }};
</script>
<script src="{{ asset('js/booking.js') }}"></script>
@endsection
