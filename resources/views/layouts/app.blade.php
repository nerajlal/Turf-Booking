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
                        <span class="text-xs font-black text-playo-dark">Bangalore</span>
                        <i class="fa-solid fa-chevron-down ml-2 text-[10px] text-playo-muted group-hover:text-playo-dark"></i>
                    </div>
                </div>

                <!-- Nav Menu (Desktop) -->
                <div class="hidden md:flex items-center space-x-8 font-bold text-sm tracking-wide">
                    <a href="#" class="text-playo-green/90 hover:text-playo-green transition-colors">PLAY</a>
                    <a href="#" class="text-playo-muted hover:text-playo-dark transition-colors">BOOK</a>
                    <a href="#" class="text-playo-muted hover:text-playo-dark transition-colors">TRAIN</a>
                </div>

                <!-- User Profile / City -->
                <div class="flex items-center space-x-4">
                    <div class="hidden sm:flex flex-col text-right">
                        <span class="text-[10px] uppercase font-bold text-playo-muted leading-tight">Welcome back</span>
                        <span class="text-sm font-black text-playo-dark">Guest User</span>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-playo-green/20 p-0.5 hover:border-playo-green transition-colors cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=Guest&background=00B562&color=fff" class="rounded-full" alt="User">
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-playo-light py-12 mt-20">
        <div class="container mx-auto px-4 text-center">
            <p class="text-playo-muted font-bold text-sm">© {{ date('Y') }} TurfPro. Redesigned with ❤️ for Sports Lovers.</p>
        </div>
    </footer>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    @yield('scripts')
</body>
</html>

