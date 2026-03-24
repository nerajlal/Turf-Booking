# TurfPRO - Premium Turf Booking System

A high-end, ultra-premium Turf Booking System built with Laravel, Bootstrap 5, and custom Vanilla JavaScript. This system features a "BookMyShow" style booking experience with a deep dark-mode aesthetic and glassmorphism effects.

![Premium UI Mockup](https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000&auto=format&fit=crop)

## ✨ Key Features
- **Ultra-Premium UI/UX**: Deep dark mode (#0f172a) with neon green accents and frosted glass effects.
- **Cinema-Style Booking**: Horizontal date scroller for the next 14 days.
- **Smart Slot Grid**: Time slots organized by Morning, Afternoon, Evening, and Night.
- **Dynamic Slot States**: Real-time visual feedback for Available, Selected, Booked, and "Fast Filling" states.
- **Live Pricing**: Floating booking summary with real-time total price calculation.
- **Responsive Design**: Fully optimized for mobile and desktop screens.

## 🛠 Tech Stack
- **Backend**: Laravel (Eloquent ORM, MVC)
- **Frontend**: Blade, Bootstrap 5, Vanilla JavaScript
- **Styling**: Custom CSS (Glassmorphism, Neon Accents)
- **Time Management**: Moment.js

## 🚀 Quick Start

1. **Clone the repository**:
   ```bash
   git clone https://github.com/nerajlal/Turf-Booking.git
   cd Turf-Booking
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**:
   ```bash
   php artisan migrate --seed --class=TurfSeeder
   ```

5. **Run the Server**:
   ```bash
   php artisan serve
   ```

---
*Built with ❤️ for a Premium Experience.*
# Turf-Booking
