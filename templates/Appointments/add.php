<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #1f1f1f;
    line-height: 1.6;
    min-height: 100vh;
    padding-top: 56px; /* Account for fixed topbar */
}

/* Background Animation */
body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 102, 204, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
    z-index: -1;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(30px, -30px) rotate(120deg); }
    66% { transform: translate(-20px, 20px) rotate(240deg); }
}

/* Main Container */
.form-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Page Header */
.page-header {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #0066cc, #22c55e, #0066cc);
    background-size: 200% 100%;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
    font-size: 28px;
}

/* Form Card */
.form-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    padding: 40px;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

/* Form Groups */
.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #1f1f1f;
    margin-bottom: 8px;
    text-transform: capitalize;
}

/* Form Controls */
.form-control,
.form-select,
.form-textarea {
    width: 100%;
    padding: 14px 18px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.2s ease;
    outline: none;
    font-family: inherit;
    color: #1f1f1f;
}

.form-control:focus,
.form-select:focus,
.form-textarea:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    background: rgba(255, 255, 255, 0.95);
}

.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 40px;
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

/* Patient Display for Logged-in Patients */
.patient-display {
    padding: 14px 18px;
    background: rgba(0, 102, 204, 0.05);
    border: 1px solid rgba(0, 102, 204, 0.2);
    border-radius: 10px;
    color: #0066cc;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.patient-display i {
    color: #0066cc;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    font-family: inherit;
    white-space: nowrap;
    min-width: 120px;
}

.btn:hover {
    text-decoration: none;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
    color: white;
}

.btn-secondary {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
    border: 1px solid #6b7280;
}

.btn-secondary:hover {
    background: #6b7280;
    color: white;
    box-shadow: 0 4px 16px rgba(107, 114, 128, 0.3);
}

.btn-outline {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.btn-outline:hover {
    background: #0066cc;
    color: white;
    box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);
}

/* Button Group */
.button-group {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Form Validation */
.form-error {
    color: #e11d48;
    font-size: 12px;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.form-error i {
    font-size: 10px;
}

/* Status Badges (for reference) */
.status-preview {
    display: flex;
    gap: 8px;
    margin-top: 8px;
    flex-wrap: wrap;
}

.status-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-scheduled { background: rgba(0, 102, 204, 0.1); color: #0066cc; }
.status-completed { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
.status-cancelled { background: rgba(225, 29, 72, 0.1); color: #e11d48; }
.status-no-show { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

/* Responsive Design */
@media (max-width: 768px) {
    .form-container {
        padding: 20px 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        padding: 24px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .form-card {
        padding: 24px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .button-group {
        flex-direction: column-reverse;
        align-items: stretch;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .page-header {
        padding: 20px;
    }
    
    .page-title {
        font-size: 20px;
    }
    
    .form-card {
        padding: 20px;
    }
    
    .form-control,
    .form-select,
    .form-textarea {
        padding: 12px 16px;
    }
}

/* Loading State */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn:disabled:hover {
    transform: none !important;
}

/* Focus Indicators */
.form-control:focus,
.form-select:focus,
.form-textarea:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
}

/* Required Field Indicator */
.required::after {
    content: ' *';
    color: #e11d48;
    font-weight: bold;
}

/* Conflict Detection Styles */
.conflict-message {
    margin-top: 8px;
    padding: 12px;
    border-radius: 8px;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.conflict-message.error {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
    border: 1px solid rgba(225, 29, 72, 0.2);
}

.conflict-message.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.2);
}

.conflict-message.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.2);
}

/* Available Slots */
.available-slots {
    margin-top: 12px;
    padding: 16px;
    background: rgba(248, 249, 250, 0.8);
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.available-slots h6 {
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
    color: #1f1f1f;
}

.slots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 8px;
}

.slot-item {
    padding: 8px 12px;
    background: white;
    border: 2px solid #0066cc;
    border-radius: 6px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 13px;
    font-weight: 500;
    color: #0066cc;
}

.slot-item:hover {
    background: #0066cc;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 102, 204, 0.3);
}

.slot-item.selected {
    background: #0066cc;
    color: white;
}

/* Alternative Doctors */
.alternative-doctors {
    margin-top: 16px;
}

.alternative-doctors .alert {
    padding: 16px;
    border-radius: 8px;
    border: 1px solid rgba(0, 102, 204, 0.2);
    background: rgba(0, 102, 204, 0.05);
}

.alternative-doctors h6 {
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
    color: #0066cc;
}

.alternative-doctor-item {
    padding: 12px;
    background: white;
    border-radius: 6px;
    margin-bottom: 8px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.alternative-doctor-item:last-child {
    margin-bottom: 0;
}

.doctor-info {
    flex: 1;
}

.doctor-name {
    font-weight: 600;
    color: #1f1f1f;
    margin-bottom: 4px;
}

.doctor-slots {
    font-size: 12px;
    color: #666;
}

.available-badge {
    padding: 4px 8px;
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
}

/* Status Badges */
.status-confirmed {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.status-in-progress {
    background: rgba(168, 85, 247, 0.1);
    color: #a855f7;
}

.status-pending-approval {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}
</style>

<div class="form-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-calendar-plus"></i>
            Add Appointment
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back to List',
            ['action' => 'index'],
            ['class' => 'btn btn-outline', 'escape' => false]
        ) ?>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <?= $this->Form->create($appointment) ?>
        
        <!-- Patient and Doctor Selection -->
        <div class="form-row">
            <div class="form-group">
                <?php if (isset($currentUser) && $currentUser->role === 'patient' && !empty($currentUser->patient_id)): ?>
                    <?= $this->Form->hidden('patient_id', ['value' => $currentUser->patient_id]) ?>
                    <label>Patient</label>
                    <div class="patient-display">
                        <i class="fas fa-user"></i>
                        <strong><?= h($currentUser->username) ?></strong>
                    </div>
                <?php else: ?>
                    <?= $this->Form->control('patient_id', [
                        'options' => $patients,
                        'class' => 'form-select',
                        'empty' => 'Select Patient',
                        'label' => ['class' => 'required']
                    ]) ?>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <?= $this->Form->control('doctor_id', [
                    'options' => $doctors,
                    'class' => 'form-select',
                    'empty' => 'Select Doctor',
                    'label' => ['class' => 'required'],
                    'id' => 'doctor_id'
                ]) ?>
            </div>
        </div>

        <!-- Date and Time -->
        <div class="form-row">
            <div class="form-group">
                <?= $this->Form->control('appointment_date', [
                    'type' => 'date',
                    'class' => 'form-control',
                    'label' => ['class' => 'required'],
                    'id' => 'appointment_date'
                ]) ?>
            </div>
            
            <div class="form-group">
                <?= $this->Form->control('appointment_time', [
                    'type' => 'time',
                    'class' => 'form-control',
                    'label' => ['class' => 'required'],
                    'id' => 'appointment_time'
                ]) ?>
                <!-- Conflict Detection Message -->
                <div id="conflict-message" class="conflict-message" style="display: none;"></div>
                <!-- Available Slots Display -->
                <div id="available-slots" class="available-slots" style="display: none;"></div>
            </div>
        </div>

        <!-- Duration -->
        <div class="form-group">
            <?= $this->Form->control('duration_minutes', [
                'type' => 'number',
                'class' => 'form-control',
                'label' => ['class' => 'required', 'text' => 'Duration (minutes)'],
                'min' => 15,
                'max' => 480,
                'step' => 15,
                'value' => $appointment->duration_minutes ?? 30,
                'id' => 'duration_minutes'
            ]) ?>
            <small class="form-text text-muted">Appointment duration in minutes (15-480, default: 30)</small>
        </div>

        <!-- Alternative Doctors (shown when conflict detected) -->
        <div id="alternative-doctors" class="alternative-doctors" style="display: none;">
            <div class="alert alert-info">
                <h6><i class="fas fa-info-circle"></i> Alternative Doctors Available</h6>
                <div id="alternatives-list"></div>
            </div>
        </div>

        <!-- Status -->
        <div class="form-group">
            <?= $this->Form->control('status', [
                'type' => 'select',
                'options' => [
                    'Scheduled' => 'Scheduled',
                    'Confirmed' => 'Confirmed',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                    'Cancelled' => 'Cancelled',
                    'No Show' => 'No Show',
                    'Pending Approval' => 'Pending Approval'
                ],
                'class' => 'form-select',
                'label' => ['class' => 'required'],
                'value' => $appointment->status ?? 'Scheduled'
            ]) ?>
            <div class="status-preview">
                <span class="status-badge status-scheduled">Scheduled</span>
                <span class="status-badge status-confirmed">Confirmed</span>
                <span class="status-badge status-in-progress">In Progress</span>
                <span class="status-badge status-completed">Completed</span>
                <span class="status-badge status-cancelled">Cancelled</span>
                <span class="status-badge status-no-show">No Show</span>
                <span class="status-badge status-pending-approval">Pending Approval</span>
            </div>
        </div>

        <!-- Remarks -->
        <div class="form-group">
            <?= $this->Form->control('remarks', [
                'type' => 'textarea',
                'class' => 'form-textarea',
                'rows' => 4,
                'placeholder' => 'Add any additional notes or special instructions...'
            ]) ?>
        </div>

        <!-- Form Actions -->
        <div class="button-group">
            <?= $this->Html->link(
                '<i class="fas fa-times"></i> Cancel',
                ['action' => 'index'],
                ['class' => 'btn btn-secondary', 'escape' => false]
            ) ?>
            <?= $this->Form->button(
                'Save Appointment',
                [
                    'class' => 'btn btn-primary',
                    'type' => 'submit',
                    'escape' => false
                ]
            ) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
// Form Enhancement
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to submit button
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('.btn-primary');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        });
    }
    
    // Auto-focus first empty field
    const firstInput = document.querySelector('.form-control:not([value]), .form-select:not([value])');
    if (firstInput) {
        firstInput.focus();
    }
    
    // Date validation (prevent past dates for new appointments)
    const dateInput = document.querySelector('input[type="date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
    }
    
    // Time validation (prevent past times for today)
    const timeInput = document.querySelector('input[type="time"]');
    if (dateInput && timeInput) {
        function validateTime() {
            const selectedDate = dateInput.value;
            const today = new Date().toISOString().split('T')[0];
            
            if (selectedDate === today) {
                const now = new Date();
                const currentTime = now.getHours().toString().padStart(2, '0') + ':' + 
                                   now.getMinutes().toString().padStart(2, '0');
                timeInput.min = currentTime;
            } else {
                timeInput.removeAttribute('min');
            }
        }
        
        dateInput.addEventListener('change', validateTime);
        validateTime(); // Run on page load
    }

    // Conflict Detection and Available Slots
    const doctorSelect = document.querySelector('select[name="doctor_id"]');
    const patientSelect = document.querySelector('select[name="patient_id"]');
    const durationInput = document.querySelector('input[name="duration_minutes"]');
    const conflictMessage = document.getElementById('conflict-message');
    const availableSlotsDiv = document.getElementById('available-slots');
    const alternativeDoctorsDiv = document.getElementById('alternative-doctors');
    const alternativesList = document.getElementById('alternatives-list');

    let checkTimeout;

    function checkAvailability() {
        const doctorId = doctorSelect?.value;
        const patientId = patientSelect?.value;
        const date = dateInput?.value;
        const time = timeInput?.value;
        const duration = durationInput?.value || 30;

        // Clear previous timeout
        if (checkTimeout) {
            clearTimeout(checkTimeout);
        }

        // Wait for user to finish typing
        checkTimeout = setTimeout(() => {
            if (!doctorId || !patientId || !date || !time) {
                conflictMessage.style.display = 'none';
                availableSlotsDiv.style.display = 'none';
                alternativeDoctorsDiv.style.display = 'none';
                return;
            }

            // Check conflict via form submission simulation (would need AJAX endpoint)
            // For now, just load available slots
            loadAvailableSlots(doctorId, date, duration);
        }, 500);
    }

    function loadAvailableSlots(doctorId, date, duration) {
        if (!doctorId || !date) return;

        fetch(`/appointments/available-slots?doctor_id=${doctorId}&date=${date}&duration=${duration}`)
            .then(response => response.json())
            .then(data => {
                if (data.slots && data.slots.length > 0) {
                    displayAvailableSlots(data.slots);
                } else {
                    availableSlotsDiv.style.display = 'none';
                    // Show alternative doctors
                    loadAlternativeDoctors(doctorId, date, timeInput?.value, duration);
                }
            })
            .catch(error => {
                console.error('Error loading available slots:', error);
            });
    }

    function displayAvailableSlots(slots) {
        availableSlotsDiv.style.display = 'block';
        availableSlotsDiv.innerHTML = `
            <h6><i class="fas fa-clock"></i> Available Time Slots</h6>
            <div class="slots-grid">
                ${slots.map(slot => `
                    <div class="slot-item" data-time="${slot.time}">
                        ${slot.time}
                    </div>
                `).join('')}
            </div>
        `;

        // Add click handlers
        availableSlotsDiv.querySelectorAll('.slot-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove previous selection
                availableSlotsDiv.querySelectorAll('.slot-item').forEach(i => i.classList.remove('selected'));
                // Add selection
                this.classList.add('selected');
                // Set time input
                if (timeInput) {
                    timeInput.value = this.dataset.time;
                }
                // Show success message
                showConflictMessage('Time slot selected: ' + this.dataset.time, 'success');
            });
        });
    }

    function loadAlternativeDoctors(doctorId, date, time, duration) {
        // Get department ID from doctors data
        const doctorsData = <?= json_encode(isset($doctorsWithDept) ? array_map(function($d) {
            return ['id' => $d->id, 'department_id' => $d->department_id];
        }, $doctorsWithDept) : []) ?>;
        
        const selectedDoctor = doctorsData.find(d => d.id == doctorId);
        const departmentId = selectedDoctor?.department_id;

        if (!departmentId || !date || !time) return;

        fetch(`/appointments/alternative-doctors?department_id=${departmentId}&date=${date}&time=${time}&duration=${duration}&exclude_doctor_id=${doctorId}`)
            .then(response => response.json())
            .then(data => {
                if (data.alternatives && data.alternatives.length > 0) {
                    displayAlternativeDoctors(data.alternatives);
                }
            })
            .catch(error => {
                console.error('Error loading alternative doctors:', error);
            });
    }

    function displayAlternativeDoctors(alternatives) {
        alternativeDoctorsDiv.style.display = 'block';
        alternativesList.innerHTML = alternatives.map(alt => `
            <div class="alternative-doctor-item">
                <div class="doctor-info">
                    <div class="doctor-name">Dr. ${alt.doctor.name}</div>
                    <div class="doctor-slots">${alt.available_slots.length} available slots</div>
                </div>
                ${alt.available ? '<span class="available-badge">Available</span>' : '<span class="available-badge" style="background: rgba(225,29,72,0.1); color: #e11d48;">Not Available</span>'}
            </div>
        `).join('');
    }

    function showConflictMessage(message, type = 'error') {
        conflictMessage.textContent = message;
        conflictMessage.className = `conflict-message ${type}`;
        conflictMessage.style.display = 'block';
        conflictMessage.innerHTML = `
            <i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'}"></i>
            ${message}
        `;
    }

    // Add event listeners
    if (doctorSelect) doctorSelect.addEventListener('change', checkAvailability);
    if (patientSelect) patientSelect.addEventListener('change', checkAvailability);
    if (dateInput) dateInput.addEventListener('change', checkAvailability);
    if (timeInput) timeInput.addEventListener('change', checkAvailability);
    if (durationInput) durationInput.addEventListener('change', checkAvailability);
});
</script>