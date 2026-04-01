document.addEventListener('DOMContentLoaded', function () {
    const dateItems = document.querySelectorAll('.date-item');
    const slotContainer = document.getElementById('slotContainer');
    const bookingFooter = document.getElementById('bookingFooter');
    const selectedCountText = document.getElementById('selectedCountText');
    const totalPriceText = document.getElementById('totalPriceText');
    const confirmBookingBtn = document.getElementById('confirmBookingBtn');

    let selectedSlots = [];
    let currentDate = null;

    // Global function to update selection from FullCalendar
    window.setSelectedSlots = function(slots, date) {
        selectedSlots = slots;
        currentDate = date;
        updateFooter();
    };

    window.updateParticipants = function(delta) {
        const input = document.getElementById('participantsCount');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > 10) val = 10;
        input.value = val;
        updateFooter();
    };

    function updateFooter() {
        const participants = parseInt(document.getElementById('participantsCount')?.value || 1);
        if (selectedSlots.length > 0) {
            bookingFooter.classList.remove('translate-y-20', 'opacity-0', 'invisible');
            bookingFooter.classList.add('translate-y-0', 'opacity-100', 'visible');
            
            selectedCountText.innerText = `${selectedSlots.length} Slot(s) Selected`;
            const total = selectedSlots.length * PRICE_PER_HOUR;
            
            if (participants > 1) {
                const perPerson = total / participants;
                totalPriceText.innerHTML = `£${total.toFixed(2)} <span class="text-xs font-black text-playo-green ml-2">(£${perPerson.toFixed(2)} per person)</span>`;
            } else {
                totalPriceText.innerText = `£${total.toFixed(2)}`;
            }
        } else {
            bookingFooter.classList.add('translate-y-20', 'opacity-0', 'invisible');
            bookingFooter.classList.remove('translate-y-0', 'opacity-100', 'visible');
        }
    }

    confirmBookingBtn.addEventListener('click', async function () {
        if (selectedSlots.length === 0) return;

        const participants = parseInt(document.getElementById('participantsCount')?.value || 1);
        confirmBookingBtn.disabled = true;
        confirmBookingBtn.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin mr-2"></i>PROCESSING...`;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        try {
            const response = await fetch('/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify({
                    turf_id: TURF_ID,
                    user_id: 1, // Mock user ID for now
                    booking_date: currentDate,
                    slots: selectedSlots,
                    total_price: selectedSlots.length * PRICE_PER_HOUR,
                    participants_count: participants
                })
            });

            const result = await response.json();

            if (result.success) {
                confirmBookingBtn.innerHTML = `<i class="fa-solid fa-check mr-2"></i>SUCCESS!`;
                confirmBookingBtn.classList.replace('bg-playo-green', 'bg-blue-600');
                
                alert(result.message);
                location.reload();
            } else {
                confirmBookingBtn.disabled = false;
                confirmBookingBtn.innerHTML = `PROCEED TO PAY <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>`;
                alert(result.message || 'Booking failed. One or more slots might have been taken.');
            }
        } catch (error) {
            confirmBookingBtn.disabled = false;
            confirmBookingBtn.innerHTML = `PROCEED TO PAY <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>`;
            alert('A network error occurred. Please try again.');
        }
    });

    function addOneHour(time) {
        const [h, m] = time.split(':');
        let hour = parseInt(h) + 1;
        return `${hour.toString().padStart(2, '0')}:${m}`;
    }
});

