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
        <div class="card-playo group flex flex-col h-full hover:shadow-2xl transition-all duration-500">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ $event->image ?? 'https://images.unsplash.com/photo-1526232762683-2175bc9dd45k?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $event->title }}">
                <div class="absolute top-6 left-6">
                    <div class="glass-playo p-3 rounded-2xl text-center min-w-[60px] border-white/50">
                        <p class="text-[10px] font-black text-playo-muted leading-none mb-1 uppercase">{{ $event->event_date->format('M') }}</p>
                        <p class="text-xl font-black text-playo-dark leading-none">{{ $event->event_date->format('d') }}</p>
                    </div>
                </div>
                <div class="absolute bottom-4 right-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-300">
                    <span class="bg-playo-green text-white text-[10px] font-black px-4 py-2 rounded-full shadow-lg">TICKETS AVAILABLE</span>
                </div>
            </div>

            <div class="p-8 flex-grow flex flex-col">
                <h3 class="text-2xl font-black text-playo-dark mb-4 group-hover:text-playo-green transition-colors">{{ $event->title }}</h3>
                <p class="text-sm font-bold text-playo-muted leading-relaxed mb-8 flex-grow">
                    {{ Str::limit($event->description, 100) }}
                </p>
                
                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <div>
                        <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest mb-1">Entry Fee</p>
                        <p class="text-2xl font-black text-playo-dark">${{ number_format($event->price, 2) }}</p>
                    </div>
                    <button class="btn-playo-primary px-8 h-12">BOOK NOW</button>
                </div>
            </div>
        </div>
        @empty
        <!-- Mock Events for Demo -->
        @foreach(['Elite Football Cup 2026', 'Summer Cricket Bash', 'Open Badminton Night'] as $mockTitle)
        <div class="card-playo group flex flex-col h-full hover:shadow-2xl transition-all duration-500">
            <div class="relative h-64 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1541534741688-6078c65b5a33?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $mockTitle }}">
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
                    <button class="btn-playo-primary px-8 h-12">BOOK NOW</button>
                </div>
            </div>
        </div>
        @endforeach
        @endforelse
    </div>
</div>
@endsection
