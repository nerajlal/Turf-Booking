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
            // Reset active state for all items
            dateItems.forEach(i => {
                i.classList.remove('bg-playo-green', 'border-playo-green');
                i.classList.add('bg-white', 'border-gray-100');
                
                const dayText = i.querySelector('.text-\\[10px\\]');
                const numText = i.querySelector('.text-xl');
                
                dayText.classList.remove('text-white/80');
                dayText.classList.add('text-playo-muted');
                
                numText.classList.remove('text-white');
                numText.classList.add('text-playo-dark');
            });

            // Set active state for clicked item
            this.classList.remove('bg-white', 'border-gray-100');
            this.classList.add('bg-playo-green', 'border-playo-green');
            
            const dayText = this.querySelector('.text-\\[10px\\]');
            const numText = this.querySelector('.text-xl');
            
            dayText.classList.remove('text-playo-muted');
            dayText.classList.add('text-white/80');
            
            numText.classList.remove('text-playo-dark');
            numText.classList.add('text-white');

            currentDate = this.dataset.date;
            selectedSlots = [];
            updateFooter();
            fetchSlots(currentDate);
        });
    });

    async function fetchSlots(date) {
        slotContainer.innerHTML = `
            <div class="flex flex-col items-center justify-center py-20 text-playo-muted animate-pulse">
                <i class="fa-solid fa-circle-notch fa-spin text-4xl mb-4 opacity-20"></i>
                <p class="font-bold">Fetching latest slots...</p>
            </div>`;
        
        try {
            const response = await fetch(`/api/slots?turf_id=${TURF_ID}&date=${date}`);
            const slots = await response.json();
            renderSlots(slots);
        } catch (error) {
            slotContainer.innerHTML = `
                <div class="bg-red-50 border border-red-100 rounded-2xl p-8 text-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-2xl mb-2"></i>
                    <p class="text-red-900 font-black">Failed to load slots</p>
                    <p class="text-red-700 text-xs font-bold">Please refresh the page and try again.</p>
                </div>`;
        }
    }

    function renderSlots(slots) {
        const sections = ['Morning', 'Afternoon', 'Evening', 'Night'];
        const sectionIcons = {
            'Morning': 'fa-sun',
            'Afternoon': 'fa-cloud-sun',
            'Evening': 'fa-moon',
            'Night': 'fa-stars'
        };
        
        let html = '';

        sections.forEach(section => {
            const sectionSlots = slots.filter(s => s.section === section);
            if (sectionSlots.length > 0) {
                html += `
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-playo-light rounded-lg flex items-center justify-center text-playo-muted text-xs">
                                <i class="fa-solid ${sectionIcons[section] || 'fa-clock'}"></i>
                            </div>
                            <h6 class="text-xs font-black text-playo-dark uppercase tracking-widest">${section}</h6>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">`;
                
                sectionSlots.forEach(slot => {
                    const isBooked = slot.status === 'booked';
                    const isFastFilling = slot.fast_filling;
                    
                    const baseClass = "relative flex items-center justify-center py-4 rounded-xl font-black text-sm transition-all duration-200 border-2";
                    const statusClass = isBooked 
                        ? "bg-gray-50 border-gray-100 text-gray-300 cursor-not-allowed italic" 
                        : "bg-white border-gray-100 text-playo-dark hover:border-playo-green/50 hover:bg-playo-green/5 cursor-pointer";
                    
                    html += `
                        <button class="${baseClass} ${statusClass}" 
                             data-time="${slot.time}" 
                             ${isBooked ? 'disabled' : `onclick="toggleSlot(this, '${slot.time}')"`}>
                            ${isBooked ? '<i class="fa-solid fa-lock mr-2 text-[10px] opacity-30"></i>' : ''}
                            ${slot.time}
                            ${isFastFilling && !isBooked ? '<div class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full animate-ping"></div>' : ''}
                        </button>`;
                });

                html += `</div></div>`;
            }
        });

        slotContainer.innerHTML = html || `
            <div class="flex flex-col items-center justify-center py-20 text-playo-muted">
                <i class="fa-solid fa-calendar-xmark text-4xl mb-4 opacity-20"></i>
                <p class="font-bold">No slots available for this date</p>
            </div>`;
    }

    window.toggleSlot = function (element, time) {
        if (element.hasAttribute('disabled')) return;

        const isSelected = element.classList.contains('bg-playo-green');
        
        if (!isSelected) {
            // Select
            element.classList.remove('bg-white', 'border-gray-100', 'text-playo-dark');
            element.classList.add('bg-playo-green', 'border-playo-green', 'text-white', 'shadow-lg', 'shadow-playo-green/20', '-translate-y-1');
            selectedSlots.push(time);
        } else {
            // Deselect
            element.classList.add('bg-white', 'border-gray-100', 'text-playo-dark');
            element.classList.remove('bg-playo-green', 'border-playo-green', 'text-white', 'shadow-lg', 'shadow-playo-green/20', '-translate-y-1');
            selectedSlots = selectedSlots.filter(t => t !== time);
        }

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
                totalPriceText.innerHTML = `£${total.toFixed(2)} <span class="text-xs font-bold text-playo-green ml-2">(£${perPerson.toFixed(2)} per person)</span>`;
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

