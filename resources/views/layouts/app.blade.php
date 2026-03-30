<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TurfPro | Book Sports Venues & More</title>
    
    <!-- Google Fonts: Figtree -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-white text-playo-dark font-figtree antialiased selection:bg-playo-green selection:text-white">
    <nav class="sticky top-0 z-[100] w-full bg-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & City Selector -->
                <div class="flex items-center space-x-6">
                    <a class="flex items-center space-x-2 group" href="/">
                        <div class="w-10 h-10 bg-playo-green rounded-xl flex items-center justify-center text-white shadow-lg shadow-playo-green/20 group-hover:scale-105 transition-transform duration-200">
                            <i class="fa-solid fa-ranking-star text-lg"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-playo-dark">TURF<span class="text-playo-green">PRO</span></span>
                    </a>

                    <div class="hidden lg:flex items-center bg-playo-light px-4 py-2 rounded-full border border-gray-100 cursor-pointer hover:bg-gray-100 transition-colors group">
                        <i class="fa-solid fa-location-dot text-playo-green mr-2 text-sm"></i>
                        <span class="text-xs font-black text-playo-dark">Northern Ireland</span>
                        <i class="fa-solid fa-chevron-down ml-2 text-[10px] text-playo-muted group-hover:text-playo-dark"></i>
                    </div>
                </div>

                <!-- Nav Menu (Desktop) -->
                <div class="hidden md:flex items-center space-x-8 font-bold text-sm tracking-wide">
                    {{-- <a href="{{ route('matchmaking.index') }}" class="transition-colors {{ request()->routeIs('matchmaking.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">PLAY</a> --}}
                    <a href="{{ route('home') }}#about" class="text-playo-muted hover:text-playo-dark transition-colors">ABOUT US</a>
                    <a href="{{ route('home') }}#gallery" class="text-playo-muted hover:text-playo-dark transition-colors">GALLERY</a>
                    <a href="{{ route('bookings.index') }}" class="transition-colors {{ request()->routeIs('bookings.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">BOOK</a>
                    {{-- <a href="{{ route('trainers.index') }}" class="transition-colors {{ request()->routeIs('trainers.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">TRAIN</a> --}}
                    <a href="{{ route('events.index') }}" class="transition-colors {{ request()->routeIs('events.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">EVENTS</a>
                </div>

                <!-- User Profile / City / Mobile Menu -->
                <div class="flex items-center space-x-4">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-[10px] uppercase font-bold text-playo-muted leading-tight">Welcome back</span>
                        <span class="text-sm font-black text-playo-dark">Guest User</span>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-playo-green/20 p-0.5 hover:border-playo-green transition-colors cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=Guest&background=00B562&color=fff" class="rounded-full" alt="User">
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-playo-dark" onclick="toggleMobileMenu()">
                        <i class="fa-solid fa-bars-staggered text-xl"></i>
                    </button>
                    
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 p-4 space-y-4 font-bold">
            {{-- <a href="{{ route('matchmaking.index') }}" class="block p-2 rounded-xl {{ request()->routeIs('matchmaking.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">PLAY</a> --}}
            <a href="{{ route('home') }}#about" class="block p-2 rounded-xl text-playo-dark hover:bg-gray-50">ABOUT US</a>
            <a href="{{ route('home') }}#gallery" class="block p-2 rounded-xl text-playo-dark hover:bg-gray-50">GALLERY</a>
            <a href="{{ route('bookings.index') }}" class="block p-2 rounded-xl {{ request()->routeIs('bookings.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">BOOK</a>
            {{-- <a href="{{ route('trainers.index') }}" class="block p-2 rounded-xl {{ request()->routeIs('trainers.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">TRAIN</a> --}}
            <a href="{{ route('events.index') }}" class="block p-2 rounded-xl {{ request()->routeIs('events.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">EVENTS</a>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-playo-dark pt-20 pb-10 text-white relative overflow-hidden">
        <!-- Decoration Gradients -->
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-playo-green via-white/10 to-playo-green opacity-30"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-playo-green opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-playo-green opacity-5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12 mb-16">
                <!-- Brand Column -->
                <div class="col-span-2 lg:col-span-1 space-y-6">
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-playo-green rounded-xl flex items-center justify-center text-white shadow-lg shadow-playo-green/20">
                            <i class="fa-solid fa-trophy text-xl"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tighter uppercase">THE GRAND ARENA</span>
                    </div>
                    <p class="text-white/50 text-sm font-bold leading-relaxed">
                        The ultimate destination for sports enthusiasts. Professional grade turfs, expert coaching, and a vibrant community.
                    </p>
                    <div class="flex items-center space-x-4 pt-4">
                        <a href="#" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-playo-green hover:text-white transition-all transform hover:-translate-y-1">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-playo-green hover:text-white transition-all transform hover:-translate-y-1">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-playo-green hover:text-white transition-all transform hover:-translate-y-1">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation Column -->
                <div class="col-span-1 space-y-6">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-playo-green">Experience</h4>
                    <ul class="space-y-4 font-bold text-sm">
                        <li><a href="{{ route('bookings.index') }}" class="text-white/60 hover:text-white transition-colors flex items-center"><span class="w-1 h-1 bg-playo-green rounded-full mr-3"></span> Book</a></li>
                        <li><a href="{{ route('home') }}#gallery" class="text-white/60 hover:text-white transition-colors flex items-center"><span class="w-1 h-1 bg-playo-green rounded-full mr-3"></span> Gallery</a></li>
                        <li><a href="{{ route('home') }}#about" class="text-white/60 hover:text-white transition-colors flex items-center"><span class="w-1 h-1 bg-playo-green rounded-full mr-3"></span> About</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-white/60 hover:text-white transition-colors flex items-center"><span class="w-1 h-1 bg-playo-green rounded-full mr-3"></span> Events</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div class="col-span-1 space-y-6">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-playo-green">Contact</h4>
                    <ul class="space-y-4 font-bold text-sm">
                        <li class="flex items-start space-x-3 text-white/60">
                            <i class="fa-solid fa-location-dot mt-1 text-playo-green/50"></i>
                            <span class="text-[10px] leading-tight">Belfast, NI</span>
                        </li>
                        <li class="flex items-start space-x-3 text-white/60">
                            <i class="fa-solid fa-envelope mt-1 text-playo-green/50"></i>
                            <span class="text-[10px] truncate">hello@grandarena.com</span>
                        </li>
                        <li class="flex items-start space-x-3 text-white/60">
                            <i class="fa-solid fa-phone mt-1 text-playo-green/50"></i>
                            <span class="text-[10px] truncate">+44 28 9012 3456</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter Column -->
                <div class="col-span-2 lg:col-span-1 space-y-6">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-playo-green">Updates</h4>
                    <p class="text-white/50 text-xs font-bold leading-relaxed">
                        Subscribe for exclusive offers and more.
                    </p>
                    <div class="relative group">
                        <input type="email" placeholder="Your Email" class="w-full h-14 bg-white/5 border border-white/10 rounded-2xl pl-5 pr-14 text-sm font-bold focus:outline-none focus:border-playo-green transition-all">
                        <button class="absolute top-2 right-2 w-10 h-10 bg-playo-green text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-lg shadow-playo-green/20">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-white/30 text-[10px] font-black uppercase tracking-widest">
                    © {{ date('Y') }} THE GRAND ARENA. ALL RIGHTS RESERVED.
                </p>
                <div class="flex items-center space-x-8 text-[10px] font-black uppercase tracking-widest text-white/20">
                    <a href="#" class="hover:text-playo-green transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-playo-green transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    @yield('scripts')
</body>
</html>

