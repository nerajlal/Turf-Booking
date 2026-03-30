@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20">
    <div class="flex flex-col md:flex-row items-end justify-between mb-16 gap-8 text-center md:text-left">
        <div>
            <div class="inline-flex items-center px-4 py-1.5 bg-playo-light rounded-full border border-gray-100 mb-4">
                <span class="text-[10px] font-black text-playo-green uppercase tracking-widest">Local Tournaments</span>
            </div>
            <h1 class="text-5xl font-black text-playo-dark leading-none tracking-tight">SPORTS EVENTS</h1>
        </div>
        <p class="max-w-md text-playo-muted font-bold leading-relaxed">
            Join the most exciting local tournaments and sports meetups in Northern Ireland. Book your tickets and get your QR check-in instantly.
        </p>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($events as $event)
        @php $isBooked = in_array($event->id, $userBookings ?? []); @endphp
        <div class="card-playo group flex flex-col h-full {{ $isBooked ? 'border-playo-green/30' : '' }} hover:shadow-2xl transition-all duration-500">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ $event->image ? asset($event->image) : asset('images/event_football.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 {{ $isBooked ? 'grayscale-[0.5]' : '' }}" alt="{{ $event->title }}">
                <div class="absolute top-6 left-6">
                    <div class="glass-playo p-3 rounded-2xl text-center min-w-[60px] border-white/50">
                        <p class="text-[10px] font-black text-playo-muted leading-none mb-1 uppercase">{{ $event->event_date->format('M') }}</p>
                        <p class="text-xl font-black text-playo-dark leading-none">{{ $event->event_date->format('d') }}</p>
                    </div>
                </div>
                @if($isBooked)
                <div class="absolute inset-0 bg-playo-green/10 flex items-center justify-center backdrop-blur-[2px]">
                    <div class="bg-white/90 px-6 py-3 rounded-2xl shadow-xl flex items-center space-x-3 border border-playo-green/20">
                        <i class="fa-solid fa-circle-check text-playo-green text-xl"></i>
                        <span class="font-black text-playo-dark tracking-tight">YOU ARE BOOKED</span>
                    </div>
                </div>
                @else
                <div class="absolute bottom-4 right-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                    <span class="bg-playo-green text-white text-[10px] font-black px-4 py-2 rounded-full shadow-lg">TICKETS AVAILABLE</span>
                </div>
                @endif
            </div>

            <div class="p-8 flex-grow flex flex-col">
                <h3 class="text-2xl font-black text-playo-dark mb-4 group-hover:text-playo-green transition-colors">{{ $event->title }}</h3>
                <p class="text-sm font-bold text-playo-muted leading-relaxed mb-6 flex-grow">
                    {{ Str::limit($event->description, 100) }}
                </p>
                
                @if($isBooked)
                @php 
                    $booking = \App\Models\EventBooking::where('user_id', 1)->where('event_id', $event->id)->first();
                @endphp
                <div class="bg-playo-light/50 p-6 rounded-2xl border border-gray-100 mb-8 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Ticket ID (UUID)</p>
                            <p class="text-[8px] font-black text-playo-dark break-all leading-tight max-w-[150px] uppercase">
                                {{ $booking->ticket_id }}
                            </p>
                        </div>
                        <div class="w-20 h-20 bg-white rounded-xl p-2 border border-gray-100 flex items-center justify-center shadow-inner">
                            {!! QrCode::size(100)->generate($booking->ticket_id) !!}
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 pt-4 border-t border-gray-200/50">
                        <div class="flex-1">
                            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Booking Time</p>
                            <p class="text-xs font-bold text-playo-dark">{{ now()->format('h:i A') }}</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Split Payment</p>
                            <p class="text-xs font-bold text-playo-green flex items-center">
                                <i class="fa-solid fa-check-double mr-1 text-[8px]"></i> DONE
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="flex items-center justify-between pt-6 border-t border-gray-100 mt-auto">
                    <div>
                        <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Entry Fee</p>
                        <p class="text-2xl font-black text-playo-dark">${{ number_format($event->price, 2) }}</p>
                    </div>
                    @if($isBooked)
                    <button class="bg-gray-100 text-playo-muted font-black px-8 h-12 rounded-full cursor-not-allowed" disabled>VIEW TICKET</button>
                    @else
                    <form action="{{ route('events.book', $event) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-playo-primary px-8 h-12">BOOK NOW</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <!-- Mock Events for Demo -->
        @foreach(['Elite Football Cup 2026', 'Summer Cricket Bash', 'Open Badminton Night'] as $mockTitle)
        <div class="card-playo group flex flex-col h-full hover:shadow-2xl transition-all duration-500">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('images/event_badminton.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $mockTitle }}">
                <div class="absolute top-6 left-6">
                    <div class="glass-playo p-3 rounded-2xl text-center min-w-[60px] border-white/50">
                        <p class="text-[10px] font-black text-playo-muted leading-none mb-1 uppercase">APR</p>
                        <p class="text-xl font-black text-playo-dark leading-none">12</p>
                    </div>
                </div>
            </div>
            <div class="p-8 flex-grow flex flex-col">
                <h3 class="text-2xl font-black text-playo-dark mb-4 group-hover:text-playo-green transition-colors">{{ $mockTitle }}</h3>
                <p class="text-sm font-bold text-playo-muted leading-relaxed mb-8 flex-grow">
                    Experience the ultimate sports event with premium facilities and competitive matches. Join the Northern Ireland community.
                </p>
                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <div>
                        <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Entry Fee</p>
                        <p class="text-2xl font-black text-playo-dark">$25.00</p>
                    </div>
                    <button onclick="alert('Ticket booking for {{ $mockTitle }} is currently being processed!')" class="btn-playo-primary px-8 h-12">BOOK NOW</button>
                </div>
            </div>
        </div>
        @endforeach
        @endforelse
    </div>
</div>
@endsection
