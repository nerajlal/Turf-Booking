# Full Turf Booking System Strategy & Implementation Guide

This document is your master reference for understanding and extending the **TurfPRO** booking system.

---

## 1. System Architecture
The system follows a standard Laravel MVC pattern but places heavy emphasis on the **Frontend Experience** via AJAX-driven updates.

- **Models**: `Turf` (Storage for turf metadata/images) and `Booking` (Tracks reservations).
- **Controller**: `BookingController` handles the partition logic for time slots.
- **JS Layer**: `booking.js` manages the interactive UI state without page reloads.

---

## 2. Database Preparation
Ensure your `mysql` or `postgresql` database is running and configured in `.env`.

### Migrations:
- **turfs**: `id, name, location, price_per_hour, description, images(JSON)`
- **bookings**: `id, turf_id, user_id, booking_date, start_time, end_time, total_price, payment_status`

### Seeding:
```bash
php artisan db:seed --class=TurfSeeder
```

---

## 3. The "Ultra-Premium" Look (Custom CSS)
The UI is defined in `resources/views/layouts/app.blade.php`. Key variables:
- `--bg-color: #0f172a;` (Deep Dark)
- `--accent-color: #10b981;` (Neon Green)
- `.glass-card`: Uses `backdrop-filter: blur(12px)` for the frosted look.

---

## 4. Slot Partition Logic
The slots are dynamically generated into 4 categories in `BookingController@getSlots`:
1. **Morning**: 06:00 - 12:00
2. **Afternoon**: 12:00 - 16:00
3. **Evening**: 16:00 - 20:00
4. **Night**: 20:00 - 00:00

---

## 5. UI Components Breakdown

### Horizontal Date Scroller
Located in `bookings/index.blade.php`. It uses a flex container with `overflow-x: auto` and hidden scrollbars to provide a mobile-first "swipe" feel.

### Slot Badges
- **Pulsing Border**: Added to "Fast Filling" slots via the `.pulse` CSS animation.
- **Selection State**: Handled in `booking.js` by toggling the `.selected` class.

---

## 6. API Integration
The frontend fetches slots via GET `/api/slots`.
- **Params**: `turf_id`, `date`
- **Response**: JSON array of slot objects with `status` and `fast_filling` flags.

---

## 7. Troubeshooting & Deployment

### Git Push Rejected?
If you see "! [rejected] main -> main (fetch first)", it means the remote repository has commits you don't have. Run:
```bash
git pull origin main --rebase
git push origin main
```

### Missing Images?
Ensure `images` are stored as a JSON array in the database. If using local storage, run `php artisan storage:link`.

---
*Built for Performance and Luxury.*
