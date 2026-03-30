@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-[650px] flex items-center overflow-hidden bg-playo-dark">
    <!-- Background Image Collage (Mockup effect with layers) -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-playo-dark via-playo-dark/80 to-transparent z-10"></div>
        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" class="w-full h-full object-cover opacity-60" alt="Sports Grounds">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-black text-white leading-[1.1] mb-6 tracking-tight">
                BOOK SPORTS VENUES. <br>
                <span class="text-playo-green">JOIN GAMES.</span> <br>
                FIND TRAINERS.
            </h1>
            <p class="text-lg md:text-xl text-gray-300 font-medium mb-10 max-w-xl leading-relaxed">
                The world’s largest sports community. Book turfs, courts, and trainers near you in seconds.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('bookings.index', ['id' => $firstTurf->id ?? 1]) }}" class="btn-playo-primary h-16 px-10 text-lg">
                    BOOK A VENUE <i class="fa-solid fa-arrow-right ml-3"></i>
                </a>
                <a href="{{ route('matchmaking.index') }}" class="bg-white/10 backdrop-blur-md border border-white/20 text-white btn-playo h-16 px-10 text-lg hover:bg-white/20 transition-all flex items-center justify-center">
                    JOIN A GAME
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Badge (Playo Style) -->
    <div class="absolute bottom-10 right-10 hidden xl:flex items-center space-x-4 bg-white p-4 rounded-2xl shadow-2xl animate-bounce-slow">
        <div class="w-12 h-12 bg-playo-green rounded-xl flex items-center justify-center text-white">
            <i class="fa-solid fa-mobile-screen-button text-xl"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-playo-muted uppercase tracking-widest">Get the App</p>
            <p class="text-xs font-black text-playo-dark leading-tight">SCAN TO DOWNLOAD</p>
        </div>
        <div class="w-12 h-12 bg-gray-100 rounded-lg p-1">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=playo" class="w-full h-full" alt="QR">
        </div>
    </div>
</section>

<!-- Offering Categories -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Play -->
            <a href="{{ route('matchmaking.index') }}" class="group cursor-pointer">
                <div class="card-playo p-8 text-center border-b-4 border-b-transparent hover:border-b-playo-green transition-all transform hover:-translate-y-2">
                    <div class="w-20 h-20 bg-orange-50 rounded-3xl flex items-center justify-center text-orange-500 mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-person-running text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-playo-dark mb-3">PLAY</h3>
                    <p class="text-sm font-bold text-playo-muted leading-relaxed">
                        Find sports buddies, join local games in Northern Ireland, and track your performance.
                    </p>
                </div>
            </a>
            <!-- Book -->
            <a href="{{ route('bookings.index', ['id' => $firstTurf->id ?? 1]) }}" class="group cursor-pointer">
                <div class="card-playo p-8 text-center border-b-4 border-b-transparent hover:border-b-playo-green transition-all transform hover:-translate-y-2">
                    <div class="w-20 h-20 bg-green-50 rounded-3xl flex items-center justify-center text-playo-green mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-check text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-playo-dark mb-3">BOOK</h3>
                    <p class="text-sm font-bold text-playo-muted leading-relaxed">
                        Instant booking for premium venues across Northern Ireland.
                    </p>
                </div>
            </a>
            <!-- Train -->
            <a href="{{ route('events.index') }}" class="group cursor-pointer">
                <div class="card-playo p-8 text-center border-b-4 border-b-transparent hover:border-b-playo-green transition-all transform hover:-translate-y-2">
                    <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center text-blue-500 mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-graduation-cap text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-playo-dark mb-3">TRAIN</h3>
                    <p class="text-sm font-bold text-playo-muted leading-relaxed">
                        Get world-class coaching from certified sports specialists.
                    </p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Popular Sports Grid -->
<section class="py-20 bg-playo-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black text-playo-dark mb-4">POPULAR SPORTS</h2>
            <div class="w-20 h-1.5 bg-playo-green mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $sports = [
                    ['name' => 'Badminton', 'image' => 'https://images.unsplash.com/photo-1626224580194-860f36f67a0f?auto=format&fit=crop&w=600&q=80'],
                    ['name' => 'Cricket', 'image' => 'https://images.unsplash.com/photo-1531415074968-036ba1b575da?auto=format&fit=crop&w=600&q=80'],
                    ['name' => 'Football', 'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=600&q=80'],
                    ['name' => 'Swimming', 'image' => 'https://images.unsplash.com/photo-1530549387074-d56260b37ed0?auto=format&fit=crop&w=600&q=80'],
                ];
            @endphp

            @foreach($sports as $sport)
                <div class="group relative aspect-[4/5] rounded-3xl overflow-hidden cursor-pointer shadow-xl">
                    <img src="{{ $sport['image'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $sport['name'] }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h4 class="text-xl font-black tracking-tight mb-1">{{ $sport['name'] }}</h4>
                        <div class="flex items-center text-[10px] font-black uppercase tracking-widest text-playo-green">
                            Explore Venues <i class="fa-solid fa-chevron-right ml-1"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Grid -->
<section class="py-32 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 space-y-8">
                <div class="inline-flex items-center px-4 py-2 bg-playo-light rounded-full border border-gray-100">
                    <span class="text-[10px] font-black text-playo-green uppercase tracking-widest">Experience Trainers</span>
                </div>
                <h2 class="text-5xl font-black text-playo-dark leading-tight">
                    TAKE YOUR GAME TO THE <span class="text-playo-green font-outline-2">NEXT LEVEL.</span>
                </h2>
                <p class="text-lg font-bold text-playo-muted leading-relaxed">
                    Connect with thousands of trainers across the country. Whether you're a absolute beginner or an aspiring pro, we have the right coach for you.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-playo-green">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span class="font-black text-xs text-playo-dark">Certified Coaches</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-playo-green">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span class="font-black text-xs text-playo-dark">Trial Sessions</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-playo-green">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span class="font-black text-xs text-playo-dark">Flexible Schedule</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center text-playo-green">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <span class="font-black text-xs text-playo-dark">Progress Tracking</span>
                    </div>
                </div>
                <button class="btn-playo-outline h-14 px-8 text-sm uppercase tracking-widest">Find a trainer</button>
            </div>
            <div class="lg:w-1/2 relative">
                <div class="relative z-10 rounded-[40px] overflow-hidden shadow-2xl rotate-3 transform hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1541534741688-6078c65b5a33?auto=format&fit=crop&w=800&q=80" alt="Trainer">
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-playo-green rounded-full opacity-10 blur-3xl z-0"></div>
                <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-blue-500 rounded-full opacity-10 blur-3xl z-0"></div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 4s infinite ease-in-out;
    }
    .text-outline-2 {
        -webkit-text-stroke: 1px currentColor;
        color: transparent;
    }
</style>
@endsection
