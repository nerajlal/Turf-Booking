<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Turf Booking</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --accent-color: #10b981; /* Neon Green */
            --accent-glow: rgba(16, 185, 129, 0.3);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --glass-border: rgba(255, 255, 255, 0.1);
            --selected-bg: #10b981;
            --booked-bg: #334155;
            --fast-filling: #ef4444;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .premium-btn {
            background: var(--accent-color);
            border: none;
            color: var(--bg-color);
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px var(--accent-glow);
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px var(--accent-glow);
            background: #059669;
        }

        /* Nav Branding */
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -1px;
            color: var(--accent-color) !important;
        }

        /* Glassmorphism Sections */
        .section-header {
            color: var(--text-secondary);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            height: 4px;
            width: 4px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--accent-color);
            border-radius: 10px;
        }

        @keyframes pulse-border {
            0% { border-color: var(--accent-color); }
            50% { border-color: var(--fast-filling); box-shadow: 0 0 8px var(--fast-filling); }
            100% { border-color: var(--accent-color); }
        }

        .pulse {
            animation: pulse-border 2s infinite;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom border-dark py-3">
        <div class="container">
            <a class="navbar-brand" href="#">TURF<span class="text-white">PRO</span></a>
            <div class="ms-auto d-flex align-items-center">
                <div class="glass-card px-3 py-1 d-none d-md-block">
                    <span class="text-secondary small">Welcome,</span>
                    <span class="fw-bold small">Guest</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    @yield('scripts')
</body>
</html>
