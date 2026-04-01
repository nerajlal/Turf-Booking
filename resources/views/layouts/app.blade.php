<!DOCTYPE html>
<html lang="en" class="h-full">
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
<body class="h-full bg-white text-playo-dark font-figtree antialiased selection:bg-playo-green selection:text-white">
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm backdrop-blur-md bg-white/90">
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
                    @php 
                        $firstTurfId = \App\Models\Turf::first()->id ?? 1; 
                    @endphp
                    <a href="{{ route('matchmaking.index') }}" class="transition-colors {{ request()->routeIs('matchmaking.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">PLAY</a>
                    <a href="{{ route('bookings.index', ['id' => $firstTurfId]) }}" class="transition-colors {{ request()->routeIs('bookings.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">BOOK</a>
                    <a href="{{ route('events.index') }}" class="transition-colors {{ request()->routeIs('events.*') ? 'text-playo-green' : 'text-playo-muted hover:text-playo-dark' }}">TRAIN</a>
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
            <a href="{{ route('matchmaking.index') }}" class="block p-2 rounded-xl {{ request()->routeIs('matchmaking.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">PLAY</a>
            <a href="{{ route('bookings.index', ['id' => $firstTurfId]) }}" class="block p-2 rounded-xl {{ request()->routeIs('bookings.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">BOOK</a>
            <a href="{{ route('events.index') }}" class="block p-2 rounded-xl {{ request()->routeIs('events.*') ? 'bg-playo-light text-playo-green' : 'text-playo-dark hover:bg-gray-50' }}">TRAIN</a>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-playo-dark text-white pt-20 pb-10 mt-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand & Description -->
                <div class="space-y-6">
                    <a class="flex items-center space-x-2 group" href="/">
                        <div class="w-10 h-10 bg-playo-green rounded-xl flex items-center justify-center text-white shadow-lg shadow-playo-green/20 group-hover:scale-105 transition-transform duration-200">
                            <i class="fa-solid fa-ranking-star text-lg"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white uppercase">TURF<span class="text-playo-green">PRO</span></span>
                    </a>
                    <p class="text-playo-muted leading-relaxed max-w-xs">
                        The world's largest sports community. Book turfs, courts, and trainers near you in seconds. Join the revolution of sports enthusiasts.
                    </p>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="social-icon" title="Instagram">
                            <i class="fa-brands fa-instagram text-lg"></i>
                        </a>
                        <a href="#" class="social-icon" title="Facebook">
                            <i class="fa-brands fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#" class="social-icon" title="Twitter">
                            <i class="fa-brands fa-x-twitter text-lg"></i>
                        </a>
                        <a href="#" class="social-icon" title="LinkedIn">
                            <i class="fa-brands fa-linkedin-in text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Explore -->
                <div>
                    <h4 class="text-lg font-black mb-6 uppercase tracking-wider text-white/90">Explore</h4>
                    <ul class="space-y-4 font-bold">
                        <li><a href="{{ route('matchmaking.index') }}" class="footer-link">Join a Game</a></li>
                        <li><a href="{{ route('bookings.index', ['id' => $firstTurfId]) }}" class="footer-link">Book a Venue</a></li>
                        <li><a href="{{ route('events.index') }}" class="footer-link">Find a Trainer</a></li>
                        <li><a href="#" class="footer-link">Corporate Sports</a></li>
                        <li><a href="#" class="footer-link">List Your Venue</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="text-lg font-black mb-6 uppercase tracking-wider text-white/90">Company</h4>
                    <ul class="space-y-4 font-bold">
                        <li><a href="#" class="footer-link">About Us</a></li>
                        <li><a href="#" class="footer-link">Our Story</a></li>
                        <li><a href="#" class="footer-link">Careers</a></li>
                        <li><a href="#" class="footer-link">Contact Support</a></li>
                        <li><a href="#" class="footer-link">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- App Promotion -->
                <div class="space-y-8">
                    <h4 class="text-lg font-black mb-6 uppercase tracking-wider text-white/90">Get the App</h4>
                    <div class="space-y-4">
                        <a href="#" class="app-download-btn">
                            <svg class="w-7 h-7 text-white" viewBox="0 0 384 512" fill="currentColor"><path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 21.8-88.5 21.8-11.4 0-43.8-19-69.8-19-33.4 0-64.1 18.8-81.3 48.6-34.9 60.1-8.9 149.1 24.8 197.8 16.5 23.8 36.4 50.4 62.1 49.4 25.3-1 34.9-16.2 65.5-16.2 30.7 0 39.4 16.2 65.5 15.2 26.2-1 43.6-24 59.8-47.7 18.2-26.8 25.7-52.7 25.9-54.1-.1-.1-50.7-19.5-51.1-76.3zm-51.8-164c15.6-18.9 26.1-45.2 23.3-71.3-22.5 1-49.8 15.1-66 33.9-14.6 16.8-27.3 43.8-23.7 69.3 25.2 2 50.8-12.8 66.4-31.9z"/></svg>
                            <div class="flex flex-col leading-none">
                                <span class="text-[8px] font-black text-white/50 uppercase tracking-widest mb-1">Download on</span>
                                <span class="text-base font-black tracking-tight">App Store</span>
                            </div>
                        </a>
                        <a href="#" class="app-download-btn">
                            <svg class="w-7 h-7 text-white/90" viewBox="0 0 512 512" fill="currentColor"><path d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/></svg>
                            <div class="flex flex-col leading-none">
                                <span class="text-[8px] font-black text-white/50 uppercase tracking-widest mb-1">Get it on</span>
                                <span class="text-base font-black tracking-tight">Google Play</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                <p class="text-playo-muted text-xs font-bold">
                    © {{ date('Y') }} TurfPro. All sports reserved.
                </p>
                <div class="flex items-center space-x-6 text-[10px] font-black uppercase tracking-widest text-playo-muted">
                    <a href="#" class="hover:text-playo-green transition-colors">Privacy</a>
                    <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                    <a href="#" class="hover:text-playo-green transition-colors">Terms</a>
                    <span class="w-1 h-1 bg-white/10 rounded-full"></span>
                    <a href="#" class="hover:text-playo-green transition-colors">Cookie Policy</a>
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

