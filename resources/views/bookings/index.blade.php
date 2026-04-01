@extends('layouts.app')

@section('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css' rel='stylesheet' />
<style>
    .fc-v-event { background-color: #4ade80 !important; border-color: #4ade80 !important; }
    .fc-timegrid-slot { height: 4em !important; }
    #calendar { min-height: 600px; }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Turf Details (Left Sidebar) -->
        <div class="lg:w-1/3 xl:w-1/4">
            <div class="sticky top-28 space-y-6">
                <!-- Main Card (Premium) -->
                <div class="card-playo p-0 overflow-hidden group">
                    <!-- Gallery Preview -->
                    <div class="relative aspect-[4/3] overflow-hidden">
                        <div id="mainGallery" class="h-full">
                            @if($turf->images && count($turf->images) > 0)
                                <img src="{{ asset($turf->images[0]) }}" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110" id="currentImage" alt="{{ $turf->name }}">
                            @else
                                <div class="w-full h-full bg-playo-light flex items-center justify-center text-playo-muted">
                                    <i class="fa-solid fa-image text-4xl opacity-20"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="absolute top-4 left-4 z-10">
                            <span class="glass-playo text-playo-dark text-[10px] font-black px-4 py-2 rounded-full shadow-xl border-white/50 backdrop-blur-md">
                                <i class="fa-solid fa-star text-playo-green mr-1"></i> {{ $turf->rating_avg ?? 'N/A' }}
                            </span>
                        </div>

                        <!-- Thumbnails Overlay -->
                        @if($turf->images && count($turf->images) > 1)
                        <div class="absolute bottom-4 left-4 right-4 flex gap-2">
                            @foreach(array_slice($turf->images, 0, 4) as $index => $img)
                            <div 
                                class="w-12 h-12 rounded-xl border-2 {{ $index == 0 ? 'border-playo-green' : 'border-white/50' }} overflow-hidden cursor-pointer backdrop-blur-sm transition-all hover:scale-110"
                                onclick="document.getElementById('currentImage').src = '{{ asset($img) }}'; this.parentElement.querySelectorAll('div').forEach(d => d.classList.remove('border-playo-green')); this.classList.add('border-playo-green');"
                            >
                                <img src="{{ asset($img) }}" class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-8">
                        <div class="flex items-center space-x-2 text-[10px] font-black text-playo-green uppercase tracking-widest mb-3">
                            <span class="w-2 h-2 rounded-full bg-playo-green animate-pulse"></span>
                            <span>Open Now</span>
                        </div>
                        <h2 class="text-3xl font-black text-playo-dark leading-none mb-3 tracking-tight">{{ $turf->name }}</h2>
                        <div class="flex items-center text-playo-muted text-xs font-bold mb-8">
                            <i class="fa-solid fa-location-dot text-playo-green mr-2"></i>
                            {{ $turf->location }}
                        </div>
                        
                        <div class="p-6 bg-playo-light rounded-[24px] mb-8 border border-gray-100/50">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-black text-playo-muted uppercase tracking-widest">Price per hour</span>
                                <span class="text-xs font-black text-playo-green underline decoration-2 underline-offset-4">TOP RATE</span>
                            </div>
                            <div class="flex items-baseline space-x-1">
                                <span class="text-4xl font-black text-playo-dark tracking-tighter">${{ number_format($turf->price_per_hour, 0) }}</span>
                                <span class="text-playo-muted font-bold text-sm">/ hour</span>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <h6 class="text-[10px] uppercase font-black text-playo-dark tracking-widest flex items-center">
                                <span class="w-8 h-px bg-playo-green mr-3"></span> Amenities
                            </h6>
                            <div class="grid grid-cols-2 gap-3">
                                @if($turf->amenities)
                                    @foreach($turf->amenities as $amenity)
                                        <div class="flex items-center space-x-2 bg-white p-2.5 rounded-xl border border-gray-100 shadow-sm">
                                            <div class="w-6 h-6 rounded-lg bg-green-50 flex items-center justify-center text-playo-green text-[10px]">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                            <span class="text-[10px] font-black text-playo-muted truncate">{{ $amenity }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach(['Floodlights', 'Parking', 'Washroom'] as $default)
                                        <div class="flex items-center space-x-2 bg-white p-2.5 rounded-xl border border-gray-100 shadow-sm">
                                            <div class="w-6 h-6 rounded-lg bg-green-50 flex items-center justify-center text-playo-green text-[10px]">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                            <span class="text-[10px] font-black text-playo-muted">{{ $default }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50/50">
                        <button class="w-full py-4 glass-playo rounded-2xl text-[10px] font-black text-playo-dark uppercase tracking-[0.2em] hover:bg-white transition-all shadow-sm">
                            Full Venue Details <i class="fa-solid fa-arrow-up-right-from-square ml-2 opacity-30"></i>
                        </button>
                    </div>
                </div>

                <!-- Timing Card -->
                <div class="glass-playo border-none rounded-[32px] p-6 shadow-xl relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-sm font-black text-playo-dark">Venue Hours</h4>
                            <i class="fa-solid fa-clock text-playo-green opacity-30"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-center">
                                <p class="text-[10px] font-black text-playo-muted uppercase mb-1">Opens</p>
                                <p class="text-lg font-black text-playo-dark">{{ $turf->opening_hours ?? '06:00' }}</p>
                            </div>
                            <div class="h-8 w-px bg-gray-200"></div>
                            <div class="text-center">
                                <p class="text-[10px] font-black text-playo-muted uppercase mb-1">Closes</p>
                                <p class="text-lg font-black text-playo-dark">{{ $turf->closing_hours ?? '23:00' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-20 h-20 bg-playo-green/5 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>

        <!-- Booking System (Right Content) -->
        <div class="lg:w-2/3 xl:w-3/4 space-y-8">
            <!-- 1. Selection & Calendar -->
            <div class="card-playo p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-playo-dark">1. Select Date & Time</h3>
                    <div class="inline-flex items-center px-4 py-1.5 bg-playo-light rounded-full shadow-sm border border-playo-green/10">
                        <span class="text-[10px] font-black text-playo-green uppercase tracking-widest">Real-time Slots</span>
                    </div>
                </div>
                
                <div id="calendar" class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-inner"></div>
            </div>


            <!-- 3. Split Payment Options -->
            <div class="card-playo p-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-playo-dark">3. Split Payment (Optional)</h3>
                    <div class="inline-flex items-center px-3 py-1 bg-playo-green/10 rounded-lg">
                        <i class="fa-solid fa-users text-playo-green mr-2 text-[10px]"></i>
                        <span class="text-[10px] font-black text-playo-green uppercase">Group Booking</span>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1 space-y-2">
                        <p class="text-sm font-bold text-playo-dark">Number of Players</p>
                        <p class="text-xs text-playo-muted leading-relaxed">Divide the total cost equally among your friends. Booking is confirmed when everyone pays.</p>
                    </div>
                    
                    <div class="flex items-center bg-playo-light p-2 rounded-2xl border border-gray-100">
                        <button onclick="updateParticipants(-1)" class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-playo-dark hover:text-playo-green transition-colors">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" id="participantsCount" value="1" min="1" max="10" class="w-16 bg-transparent text-center font-black text-xl text-playo-dark focus:outline-none" readonly>
                        <button onclick="updateParticipants(1)" class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-playo-dark hover:text-playo-green transition-colors">
                            <i class="fa-solid fa-plus"></i>
                        </button>
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
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    const TURF_ID = {{ $turf->id }};
    const PRICE_PER_HOUR = {{ $turf->price_per_hour }};
    
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridDay',
            slotDuration: '01:00:00',
            slotMinTime: '{{ $turf->opening_hours ?? "06:00" }}',
            slotMaxTime: '{{ $turf->closing_hours ?? "23:00" }}',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridDay,timeGridWeek'
            },
            events: '/api/slots?turf_id=' + TURF_ID,
            selectable: true,
            selectOverlap: false,
            select: function(info) {
                // Determine selected slots (1-hour blocks)
                const start = new Date(info.start);
                const end = new Date(info.end);
                const slots = [];
                
                let current = new Date(start);
                while (current < end) {
                    const timeStr = current.toTimeString().substring(0, 5);
                    slots.push(timeStr);
                    current.setHours(current.getHours() + 1);
                }

                // Update global state in booking.js
                if (window.setSelectedSlots) {
                    window.setSelectedSlots(slots, info.startStr.split('T')[0]);
                }
            },
            unselect: function() {
                if (window.setSelectedSlots) {
                    window.setSelectedSlots([], null);
                }
            }
        });
        calendar.render();
    });
</script>
<script src="{{ asset('js/booking.js') }}"></script>
@endsection

