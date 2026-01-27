/**
 * Appointment Booking - Frontend Logic
 * Handles real-time validation and conflict checking
 */

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const doctorSelect = document.getElementById('doctor_id');
    const dateInput = document.getElementById('appointment_date');
    const timeInput = document.getElementById('appointment_time');
    const durationInput = document.getElementById('duration_minutes');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    // UI Elements
    const conflictMessage = document.getElementById('conflict-message');
    const availableSlotsDiv = document.getElementById('available-slots');
    const alternativeDoctorsDiv = document.getElementById('alternative-doctors');
    const waitingListPrompt = document.getElementById('waiting-list-prompt');
    const joinWaitingListBtn = document.getElementById('join-waiting-list-btn');

    if (!form || !doctorSelect || !dateInput) return;

    // Debounce function to prevent too many API calls
    const debounce = (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    };

    // Check availability
    const checkAvailability = async () => {
        const doctorId = doctorSelect.value;
        const date = dateInput.value;
        const time = timeInput.value;
        const duration = durationInput.value || 30;

        if (!doctorId || !date) {
            hideAllMessages();
            return;
        }

        // If we also have time, check specifically for conflict
        if (time) {
            // Note: In a full implementation, we would call a specific check-conflict endpoint
            // For now, we reuse the slots logic to see if our selected slot is valid
            // Or we just fetch all slots to update the UI
        }

        // Fetch available slots for this day
        try {
            // Adjust URL based on your app's path structure (e.g. /omnicare/appointments/...)
            // Using relative path assuming we are at /appointments/add
            const response = await fetch(`/appointments/available-slots?doctor_id=${doctorId}&date=${date}&duration=${duration}`);
            const data = await response.json();

            if (data.error) {
                console.error(data.error);
                return;
            }

            updateSlotsUI(data.slots);
            
            // If time is selected, validate it against slots
            if (time) {
                validateSelectedTime(time, data.slots);
            }

        } catch (error) {
            console.error('Error fetching slots:', error);
        }
    };

    const updateSlotsUI = (slots) => {
        availableSlotsDiv.innerHTML = '';
        availableSlotsDiv.style.display = 'none';
        waitingListPrompt.style.display = 'none';

        if (slots.length === 0) {
            waitingListPrompt.style.display = 'flex';
            return;
        }

        availableSlotsDiv.style.display = 'block';
        const title = document.createElement('h6');
        title.className = 'fw-bold text-muted mb-2';
        title.textContent = 'Available Slots Today:';
        availableSlotsDiv.appendChild(title);

        const slotsContainer = document.createElement('div');
        slotsContainer.className = 'd-flex flex-wrap gap-2';

        slots.forEach(slot => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = `btn btn-sm ${timeInput.value === slot ? 'btn-primary' : 'btn-outline-primary'}`;
            btn.textContent = slot;
            btn.onclick = () => {
                timeInput.value = slot;
                // Re-validate/Re-render to highlight selection
                document.querySelectorAll('#available-slots button').forEach(b => {
                    b.className = 'btn btn-sm btn-outline-primary';
                });
                btn.className = 'btn btn-sm btn-primary';
                hideConflict();
            };
            slotsContainer.appendChild(btn);
        });

        availableSlotsDiv.appendChild(slotsContainer);
    };

    const validateSelectedTime = (selectedTime, slots) => {
        // Simple check: is the time in the list of available slots?
        // Note: exact string match requires matching formats (HH:mm)
        // Ensure selectedTime is HH:mm
        const formattedTime = selectedTime.substring(0, 5);
        
        const isAvailable = slots.some(slot => slot.substring(0, 5) === formattedTime);

        if (!isAvailable) {
            showConflict('This time slot is not available. Please choose another.');
        } else {
            hideConflict();
        }
    };

    const showConflict = (msg) => {
        conflictMessage.textContent = msg;
        conflictMessage.style.display = 'block';
        submitBtn.disabled = true;
    };

    const hideConflict = () => {
        conflictMessage.style.display = 'none';
        submitBtn.disabled = false;
    };

    const hideAllMessages = () => {
        conflictMessage.style.display = 'none';
        availableSlotsDiv.style.display = 'none';
        waitingListPrompt.style.display = 'none';
        alternativeDoctorsDiv.style.display = 'none';
    };

    // Event Listeners
    const debouncedCheck = debounce(checkAvailability, 500);

    doctorSelect.addEventListener('change', debouncedCheck);
    dateInput.addEventListener('change', debouncedCheck);
    durationInput.addEventListener('change', debouncedCheck);
    timeInput.addEventListener('change', debouncedCheck);

    // Initial check if fields are pre-filled
    if (doctorSelect.value && dateInput.value) {
        checkAvailability();
    }
});
