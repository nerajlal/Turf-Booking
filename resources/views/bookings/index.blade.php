@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Turf Details (Left Sidebar) -->
        <div class="lg:w-1/3 xl:w-1/4">
            <div class="sticky top-28 space-y-6">
                <!-- Main Card -->
                <div class="card-playo p-0">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ $turf->images[0] }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" alt="{{ $turf->name }}">
                        <div class="absolute top-4 left-4">
                            <span class="bg-playo-green text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg">FEATURED</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h2 class="text-2xl font-black text-playo-dark leading-tight mb-2">{{ $turf->name }}</h2>
                        <div class="flex items-center text-playo-muted text-sm font-bold mb-6">
                            <i class="fa-solid fa-location-dot text-playo-green mr-2"></i>
                            {{ $turf->location }}
                        </div>
                        
                        <div class="flex items-baseline mb-6 space-x-1">
                            <span class="text-3xl font-black text-playo-dark">${{ number_format($turf->price_per_hour, 0) }}</span>
                            <span class="text-playo-muted font-bold text-sm">/ hour</span>
                        </div>

                        <div class="space-y-4">
                            <h6 class="text-[10px] uppercase font-black text-playo-muted tracking-widest">Amenities</h6>
                            <div class="flex flex-wrap gap-2">
                                @foreach(['Floodlights', 'Locker', 'Parking', 'Washroom'] as $amenity)
                                    <span class="bg-playo-light text-playo-dark text-[10px] font-extrabold px-3 py-1.5 rounded-full border border-gray-100">{{ $amenity }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-50 p-4">
                        <button class="w-full py-3 text-playo-green font-black text-xs uppercase tracking-widest hover:bg-playo-green/5 transition-colors rounded-xl">
                            View Venue Details <i class="fa-solid fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-blue-50 border border-blue-100 rounded-playo p-5 flex items-start space-x-4">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white shrink-0">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-blue-900 mb-1">Booking Info</h4>
                        <p class="text-xs font-bold text-blue-700 leading-relaxed">Cancel up to 24 hours before the start time for a full refund.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking System (Right Content) -->
        <div class="lg:w-2/3 xl:w-3/4 space-y-8">
            <!-- 1. Date Selection -->
            <div class="card-playo p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-playo-dark">1. Select Date</h3>
                    <div class="text-xs font-bold text-playo-muted flex items-center">
                        <i class="fa-solid fa-calendar-day mr-2"></i> {{ \Carbon\Carbon::now()->format('F Y') }}
                    </div>
                </div>
                
                <div class="flex overflow-x-auto gap-4 pb-4 no-scrollbar" id="dateScroller">
                    @for($i = 0; $i < 14; $i++)
                        @php $date = \Carbon\Carbon::now()->addDays($i); @endphp
                        <button 
                            class="date-item group flex flex-col items-center justify-center min-w-[70px] h-[90px] rounded-2xl border-2 transition-all duration-200 {{ $i == 0 ? 'bg-playo-green border-playo-green' : 'bg-white border-gray-100 hover:border-playo-green/30' }}" 
                            data-date="{{ $date->toDateString() }}"
                        >
                            <span class="text-[10px] font-black uppercase tracking-widest mb-1 {{ $i == 0 ? 'text-white/80' : 'text-playo-muted group-hover:text-playo-green' }}">
                                {{ $date->format('D') }}
                            </span>
                            <span class="text-xl font-black {{ $i == 0 ? 'text-white' : 'text-playo-dark' }}">
                                {{ $date->format('d') }}
                            </span>
                        </button>
                    @endfor
                </div>
            </div>

            <!-- 2. Slot Selection -->
            <div class="card-playo p-8 min-h-[400px]">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-xl font-black text-playo-dark">2. Choose Available Slots</h3>
                    <div class="flex gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded bg-playo-green"></div>
                            <span class="text-[10px] font-black text-playo-muted uppercase">Selected</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded bg-gray-100 border border-gray-200"></div>
                            <span class="text-[10px] font-black text-playo-muted uppercase">Available</span>
                        </div>
                    </div>
                </div>

                <div id="slotContainer" class="space-y-10">
                    <!-- Dynamic Slots will be injected here -->
                    <div class="flex flex-col items-center justify-center py-20 text-playo-muted animate-pulse">
                        <i class="fa-solid fa-clock-rotate-left text-4xl mb-4 opacity-20"></i>
                        <p class="font-bold">Fetching latest slots...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Booking Footer -->
<div 
    class="fixed bottom-8 left-1/2 -translate-x-1/2 w-[90%] max-w-2xl bg-white rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-gray-100 p-6 z-[100] transition-all duration-500 translate-y-20 opacity-0 invisible" 
    id="bookingFooter"
>
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-6">
            <div class="w-14 h-14 bg-playo-light rounded-2xl flex items-center justify-center text-playo-green">
                <i class="fa-solid fa-cart-shopping text-xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-playo-muted uppercase tracking-wider mb-1" id="selectedCountText">0 Slots Selected</p>
                <div class="flex items-baseline space-x-1">
                    <span class="text-2xl font-black text-playo-dark" id="totalPriceText">$0.00</span>
                    <span class="text-xs font-bold text-playo-muted">incl. taxes</span>
                </div>
            </div>
        </div>
        
        <button class="btn-playo-primary px-10 h-14" id="confirmBookingBtn">
            PROCEED TO PAY <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
        </button>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const TURF_ID = {{ $turf->id }};
    const PRICE_PER_HOUR = {{ $turf->price_per_hour }};
</script>
<script src="{{ asset('js/booking.js') }}"></script>
@endsection

