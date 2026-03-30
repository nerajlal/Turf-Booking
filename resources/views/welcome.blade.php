@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative h-[650px] flex items-center overflow-hidden bg-playo-dark">
    <!-- Background Image Collage (Mockup effect with layers) -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-playo-dark via-playo-dark/80 to-transparent z-10"></div>
        <img src="{{ asset('images/hero_sports_ground.png') }}" class="w-full h-full object-cover opacity-60" alt="Sports Grounds">
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
                <a href="{{ route('bookings.index') }}" class="btn-playo btn-playo-primary h-16 px-10 text-lg">
                    BOOK A SLOT <i class="fa-solid fa-arrow-right ml-3"></i>
                </a>
            </div>
        </div>
    </div>

</section>

<!-- Details & Features Section -->
<section id="about" class="py-20 bg-playo-light">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-16 items-start">
            <!-- Left: Gallery & About -->
            <div class="lg:w-2/3 space-y-12">
                <div class="relative rounded-[40px] overflow-hidden shadow-2xl bg-white p-2">
                    <img src="{{ $turf->images[0] ?? asset('images/turf_grand_arena.png') }}" class="w-full h-[500px] object-cover rounded-[32px]" alt="{{ $turf->name }}">
                    <div class="absolute bottom-10 left-10 right-10">
                        <div class="glass-playo p-8 rounded-3xl border-white/50">
                            <h2 class="text-3xl font-black text-playo-dark mb-2">{{ $turf->name }}</h2>
                            <p class="text-sm font-bold text-playo-muted flex items-center">
                                <i class="fa-solid fa-location-dot text-playo-green mr-2"></i> {{ $turf->location }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="prose prose-xl max-w-none">
                    <h3 class="text-2xl font-black text-playo-dark mb-6 uppercase tracking-wider">About Our Venue</h3>
                    <p class="text-lg text-playo-muted font-bold leading-relaxed">
                        {{ $turf->description }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($turf->amenities ?? ['Pro Lighting', 'Changing Rooms', 'Refreshments', 'Free Parking'] as $amenity)
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 flex flex-col items-center text-center group hover:border-playo-green/30 transition-all">
                        <div class="w-12 h-12 bg-playo-light rounded-2xl flex items-center justify-center text-playo-green mb-4 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-check-circle"></i>
                        </div>
                        <span class="text-xs font-black text-playo-dark uppercase tracking-widest">{{ $amenity }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right: Booking & Quick Info -->
            <div class="lg:w-1/3 sticky top-24">
                <div class="bg-playo-dark rounded-[40px] p-10 text-white shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-playo-green opacity-10 rounded-full -mr-16 -mt-16"></div>
                    
                    <h3 class="text-2xl font-black mb-8 relative z-10">BOOK YOUR SLOT</h3>
                    
                    <div class="space-y-6 mb-10 relative z-10">
                        <div class="flex items-center justify-between pb-4 border-b border-white/10">
                            <span class="text-xs font-bold text-white/60 uppercase tracking-widest">Price / Hour</span>
                            <span class="text-2xl font-black text-playo-green">£{{ number_format($turf->price_per_hour, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-4 border-b border-white/10">
                            <span class="text-xs font-bold text-white/60 uppercase tracking-widest">Opening Hours</span>
                            <span class="text-sm font-black">{{ $turf->opening_hours ?? '08:00 AM' }} - {{ $turf->closing_hours ?? '10:00 PM' }}</span>
                        </div>
                    </div>

                    <a href="{{ route('bookings.index') }}" class="btn-playo btn-playo-primary w-full h-16 text-lg shadow-playo-green/20">
                        CHECK AVAILABILITY
                    </a>

                    <p class="text-[10px] text-center text-white/40 font-bold uppercase tracking-widest mt-6">
                        <i class="fa-solid fa-lock mr-2"></i> Secure SSL Booking
                    </p>
                </div>

                <div class="mt-8 bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                    <h4 class="text-sm font-black text-playo-dark mb-4 uppercase tracking-widest">Location</h4>
                    <div class="h-40 bg-playo-light rounded-2xl mb-4 overflow-hidden relative">
                         <img src="https://api.mapbox.com/styles/v1/mapbox/light-v10/static/-5.93,54.60,13,0/400x200?access_token=pk.placeholder" class="w-full h-full object-cover grayscale" alt="Map">
                         <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-playo-green text-3xl drop-shadow-lg"></i>
                         </div>
                    </div>
                    <p class="text-xs font-bold text-playo-muted text-center leading-relaxed">
                        {{ $turf->location }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="mb-12 text-center">
            <h2 class="text-xs font-black text-playo-green uppercase tracking-[0.2em] mb-4">Visual Tour</h2>
            <h3 class="text-4xl font-black text-playo-dark uppercase tracking-tight">VUE GALLERY</h3>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            <div class="col-span-2 row-span-2 group relative overflow-hidden rounded-[40px] shadow-2xl">
                <img src="{{ $turf->images[0] ?? asset('images/turf_grand_arena.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Arena 1">
                <div class="absolute inset-0 bg-gradient-to-t from-playo-dark/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                    <p class="text-white font-bold text-lg">Main 4G Pitch</p>
                </div>
            </div>
            <div class="group relative overflow-hidden rounded-[32px] shadow-xl h-64">
                <img src="{{ $turf->images[1] ?? asset('images/football_field.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Arena 2">
            </div>
            <div class="group relative overflow-hidden rounded-[32px] shadow-xl h-64">
                <img src="{{ $turf->images[2] ?? asset('images/hero_sports_ground.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Arena 3">
            </div>
            <div class="col-span-2 group relative overflow-hidden rounded-[32px] shadow-xl h-64 md:h-auto">
                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Arena 4">
                <div class="absolute inset-0 bg-playo-green/20 mix-blend-overlay"></div>
            </div>
        </div>
    </div>
</section>

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
            <a href="{{ route('trainers.index') }}" class="group cursor-pointer">
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
                    ['name' => 'Badminton', 'image' => asset('images/badminton_court.png')],
                    ['name' => 'Cricket', 'image' => asset('images/cricket_ground.png')],
                    ['name' => 'Football', 'image' => asset('images/football_field.png')],
                    ['name' => 'Swimming', 'image' => asset('images/swimming_pool.png')],
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
                <a href="{{ route('trainers.index') }}" class="btn-playo-outline h-14 px-8 text-sm uppercase tracking-widest inline-flex items-center justify-center">Find a trainer</a>
            </div>
            <div class="lg:w-1/2 relative">
                <div class="relative z-10 rounded-[40px] overflow-hidden shadow-2xl rotate-3 transform hover:rotate-0 transition-transform duration-500">
                    <img src="{{ asset('images/trainer_action.png') }}" alt="Trainer">
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
