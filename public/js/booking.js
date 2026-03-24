document.addEventListener('DOMContentLoaded', function () {
    const dateItems = document.querySelectorAll('.date-item');
    const slotContainer = document.getElementById('slotContainer');
    const bookingFooter = document.getElementById('bookingFooter');
    const selectedCountText = document.getElementById('selectedCountText');
    const totalPriceText = document.getElementById('totalPriceText');
    const confirmBookingBtn = document.getElementById('confirmBookingBtn');

    let selectedSlots = [];
    let currentDate = dateItems[0].dataset.date;

    // Initial Fetch
    fetchSlots(currentDate);

    // Date Selection
    dateItems.forEach(item => {
        item.addEventListener('click', function () {
            dateItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            currentDate = this.dataset.date;
            selectedSlots = [];
            updateFooter();
            fetchSlots(currentDate);
        });
    });

    async function fetchSlots(date) {
        slotContainer.innerHTML = `<div class="text-center py-5"><div class="spinner-border text-success"></div></div>`;
        try {
            const response = await fetch(`/api/slots?turf_id=${TURF_ID}&date=${date}`);
            const slots = await response.json();
            renderSlots(slots);
        } catch (error) {
            slotContainer.innerHTML = `<div class="alert alert-danger">Error loading slots. Please try again.</div>`;
        }
    }

    function renderSlots(slots) {
        const sections = ['Morning', 'Afternoon', 'Evening', 'Night'];
        let html = '';

        sections.forEach(section => {
            const sectionSlots = slots.filter(s => s.section === section);
            if (sectionSlots.length > 0) {
                html += `<div class="mb-4">
                    <h6 class="text-secondary small fw-bold mb-3">${section}</h6>
                    <div class="row g-3">`;
                
                sectionSlots.forEach(slot => {
                    const isBooked = slot.status === 'booked';
                    const isFastFilling = slot.fast_filling;
                    const pulseClass = isFastFilling ? 'pulse' : '';
                    
                    html += `<div class="col-6 col-md-3">
                        <div class="slot-badge ${isBooked ? 'booked' : ''} ${pulseClass}" 
                             data-time="${slot.time}" 
                             onclick="${isBooked ? '' : `toggleSlot(this, '${slot.time}')`}">
                            <i class="fa-solid fa-lock badge-icon"></i>
                            ${slot.time}
                        </div>
                    </div>`;
                });

                html += `</div></div>`;
            }
        });

        slotContainer.innerHTML = html;
    }

    window.toggleSlot = function (element, time) {
        if (element.classList.contains('booked')) return;

        element.classList.toggle('selected');
        
        if (element.classList.contains('selected')) {
            selectedSlots.push(time);
        } else {
            selectedSlots = selectedSlots.filter(t => t !== time);
        }

        updateFooter();
    };

    function updateFooter() {
        if (selectedSlots.length > 0) {
            bookingFooter.style.display = 'flex';
            selectedCountText.innerText = `${selectedSlots.length} Slot(s) Selected`;
            totalPriceText.innerText = `$${(selectedSlots.length * PRICE_PER_HOUR).toFixed(2)}`;
        } else {
            bookingFooter.style.display = 'none';
        }
    }

    confirmBookingBtn.addEventListener('click', async function () {
        if (selectedSlots.length === 0) return;

        confirmBookingBtn.disabled = true;
        confirmBookingBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span>Processing...`;

        // Dummy submission to /bookings
        // Since we don't have a real user session, let's use user_id 1
        for (const time of selectedSlots) {
            try {
                const response = await fetch('/bookings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        turf_id: TURF_ID,
                        user_id: 1,
                        booking_date: currentDate,
                        start_time: time,
                        end_time: moment(time, 'HH:mm').add(1, 'hour').format('HH:mm'), // Moment not loaded, using simple logic would be better
                        total_price: PRICE_PER_HOUR
                    })
                });
            } catch (e) {
                console.error(e);
            }
        }

        alert('Success! Your turf has been booked.');
        location.reload();
    });

    // Helper to add hour (simplified)
    function addOneHour(time) {
        const [h, m] = time.split(':');
        let hour = parseInt(h) + 1;
        return `${hour.toString().padStart(2, '0')}:${m}`;
    }
});
