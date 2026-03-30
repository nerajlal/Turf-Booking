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

<!-- Search & Filter Section -->
<section class="relative z-30 -mt-12 mb-20">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-[32px] shadow-2xl p-6 md:p-10 border border-gray-100/50 backdrop-blur-xl">
            <form action="{{ route('home') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Global Search -->
                    <div class="md:col-span-2 relative">
                        <label class="block text-[11px] font-black text-playo-muted uppercase tracking-[0.2em] mb-2 px-1">Location or Venue</label>
                        <div class="relative group">
                            <i class="fa-solid fa-location-dot absolute left-5 top-1/2 -translate-y-1/2 text-playo-green text-lg transition-transform group-focus-within:scale-110"></i>
                            <input type="text" name="search" placeholder="Try 'Belfast' or 'Powerleague'..." 
                                class="w-full h-16 pl-14 pr-6 bg-playo-light border-none rounded-2xl font-bold text-playo-dark placeholder:text-playo-muted/60 focus:ring-2 focus:ring-playo-green/20 transition-all text-lg"
                                value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Sport Category -->
                    <div class="relative">
                        <label class="block text-[11px] font-black text-playo-muted uppercase tracking-[0.2em] mb-2 px-1">Sport</label>
                        <div class="relative group">
                            <i class="fa-solid fa-medal absolute left-5 top-1/2 -translate-y-1/2 text-playo-green text-lg transition-transform group-focus-within:scale-110"></i>
                            <select name="sport" class="w-full h-16 pl-14 pr-10 bg-playo-light border-none rounded-2xl font-bold text-playo-dark appearance-none focus:ring-2 focus:ring-playo-green/20 transition-all text-lg cursor-pointer">
                                <option value="">Any Sport</option>
                                <option value="football" {{ request('sport') == 'football' ? 'selected' : '' }}>Football</option>
                                <option value="badminton" {{ request('sport') == 'badminton' ? 'selected' : '' }}>Badminton</option>
                                <option value="cricket" {{ request('sport') == 'cricket' ? 'selected' : '' }}>Cricket</option>
                                <option value="swimming" {{ request('sport') == 'swimming' ? 'selected' : '' }}>Swimming</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-playo-muted pointer-events-none"></i>
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="relative">
                        <label class="block text-[11px] font-black text-playo-muted uppercase tracking-[0.2em] mb-2 px-1">Max Price</label>
                        <div class="relative group">
                            <i class="fa-solid fa-sterling-sign absolute left-5 top-1/2 -translate-y-1/2 text-playo-green text-lg transition-transform group-focus-within:scale-110"></i>
                            <input type="number" name="max_price" placeholder="£50" 
                                class="w-full h-16 pl-14 pr-6 bg-playo-light border-none rounded-2xl font-bold text-playo-dark placeholder:text-playo-muted/60 focus:ring-2 focus:ring-playo-green/20 transition-all text-lg"
                                value="{{ request('max_price') }}">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-2">
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="active_only" value="1" class="sr-only peer" {{ request('active_only') ? 'checked' : '' }}>
                                <div class="w-12 h-6 bg-gray-200 rounded-full peer peer-checked:bg-playo-green transition-all duration-300"></div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-all duration-300 peer-checked:translate-x-6"></div>
                            </div>
                            <span class="ml-3 text-xs font-black text-playo-dark uppercase tracking-widest">Available Now</span>
                        </label>
                        <div class="h-4 w-px bg-gray-200"></div>
                        <p class="text-[10px] font-bold text-playo-muted uppercase tracking-widest flex items-center">
                            <i class="fa-solid fa-circle-info mr-2 text-playo-green"></i> 
                            Focusing on Northern Ireland Venues
                        </p>
                    </div>
                    <button type="submit" class="w-full md:w-auto h-16 px-12 bg-playo-dark hover:bg-playo-dark/90 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] transition-all transform hover:scale-[1.02] active:scale-95 flex items-center justify-center shadow-xl shadow-playo-dark/20">
                        SEARCH NOW <i class="fa-solid fa-magnifying-glass ml-3"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Search Results -->
@if(request()->anyFilled(['search', 'sport', 'max_price']))
<section class="py-12 bg-playo-light">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- List View -->
            <div class="lg:w-2/3">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-playo-dark">
                        FOUND {{ $turfs->total() ?? 0 }} VENUES 
                        <span class="text-playo-green ml-2">IN NORTHERN IRELAND</span>
                    </h2>
                    <div class="flex items-center space-x-2 text-xs font-black text-playo-muted uppercase tracking-widest">
                        <span>Sort by:</span>
                        <select class="bg-transparent border-none focus:ring-0 text-playo-dark font-black cursor-pointer">
                            <option>Relevance</option>
                            <option>Price: Low to High</option>
                            <option>Rating</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($turfs as $turf)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $turf->images[0] ?? asset('images/hero_sports_ground.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $turf->name }}">
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black text-playo-dark uppercase tracking-widest shadow-sm">
                                        {{ $turf->location }}
                                    </span>
                                </div>
                                @if($turf->rating_avg > 4.5)
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-playo-green rounded-full text-[10px] font-black text-white uppercase tracking-widest shadow-lg">
                                        Top Rated
                                    </span>
                                </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-black text-playo-dark group-hover:text-playo-green transition-colors line-clamp-1">{{ $turf->name }}</h3>
                                    <div class="flex items-center bg-gray-50 px-2 py-1 rounded-lg">
                                        <i class="fa-solid fa-star text-yellow-400 text-[10px] mr-1"></i>
                                        <span class="text-xs font-black text-playo-dark">{{ $turf->rating_avg }}</span>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-playo-muted mb-6 line-clamp-2">{{ $turf->description }}</p>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-[10px] font-black text-playo-muted uppercase tracking-[0.2em]">Price / Hour</p>
                                        <p class="text-lg font-black text-playo-dark">£{{ number_format($turf->price_per_hour, 2) }}</p>
                                    </div>
                                    <a href="{{ route('bookings.index', $turf->id) }}" class="bg-playo-green/10 hover:bg-playo-green text-playo-green hover:text-white px-6 py-3 rounded-xl font-black text-[11px] uppercase tracking-widest transition-all">
                                        DETAILS
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-dashed border-gray-200">
                            <div class="w-20 h-20 bg-playo-light rounded-full flex items-center justify-center text-playo-muted mx-auto mb-6">
                                <i class="fa-solid fa-magnifying-glass text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-black text-playo-dark mb-2">No Venues Found</h3>
                            <p class="text-sm font-bold text-playo-muted">Try adjusting your filters or searching in a different area.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $turfs->links() }}
                </div>
            </div>

            <!-- Map View Placeholder -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 h-[600px] bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-100">
                    <div class="absolute inset-0 bg-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="https://api.mapbox.com/styles/v1/mapbox/light-v10/static/-5.93,54.60,11,0/600x800?access_token=pk.placeholder" class="w-full h-full object-cover opacity-50 grayscale" alt="Map">
                        <div class="absolute inset-0 bg-playo-green/5"></div>
                        
                        <div class="relative z-10 text-center px-8">
                            <div class="w-16 h-16 bg-white rounded-2xl shadow-xl flex items-center justify-center text-playo-green mx-auto mb-6">
                                <i class="fa-solid fa-map-location-dot text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-black text-playo-dark mb-2 tracking-tight">Interactive Map</h4>
                            <p class="text-xs font-bold text-playo-muted leading-relaxed mb-6">
                                Connect your Google Maps API key in the `.env` file to enable geolocation services.
                            </p>
                            <div class="inline-flex items-center px-4 py-2 bg-playo-dark text-white rounded-full text-[10px] font-black uppercase tracking-widest">
                                <span class="w-2 h-2 bg-playo-green rounded-full mr-2 animate-pulse"></span>
                                Live Venues in NI
                            </div>
                        </div>

                        @foreach($turfs as $turf)
                            <div class="absolute pointer-events-none" style="top: {{ rand(20, 80) }}%; left: {{ rand(20, 80) }}%">
                                <div class="w-4 h-4 bg-playo-green border-4 border-white rounded-full shadow-lg"></div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="absolute bottom-6 inset-x-6">
                        <button class="w-full bg-playo-dark text-white h-14 rounded-2xl font-black text-xs uppercase tracking-widest flex items-center justify-center space-x-3 shadow-2xl">
                            <i class="fa-solid fa-expand"></i>
                            <span>Fullscreen Map</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

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
                <button class="btn-playo-outline h-14 px-8 text-sm uppercase tracking-widest">Find a trainer</button>
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
