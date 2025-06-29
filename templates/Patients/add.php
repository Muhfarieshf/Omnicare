<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.patient-form-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0 32px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
}

/* Form Card */
.form-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.form-header h4 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.form-header i {
    font-size: 20px;
}

.form-body {
    padding: 32px;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

/* Form Groups */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #1f1f1f;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label i {
    color: #0066cc;
    font-size: 14px;
}

.form-label .required {
    color: #e11d48;
    font-size: 12px;
}

/* Form Controls */
.form-control,
.form-select {
    width: 100%;
    padding: 12px 16px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.8);
    transition: all 0.2s ease;
    outline: none;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
    color: #1f1f1f;
}

.form-control:focus,
.form-select:focus {
    border-color: #0066cc;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.form-control::placeholder {
    color: #666;
}

/* Special styling for different input types */
.form-control[type="email"] {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23666'%3E%3Cpath d='M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

.form-control[type="tel"] {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23666'%3E%3Cpath d='M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

.form-control[type="date"] {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23666'%3E%3Cpath d='M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
}

/* Select styling */
.form-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23666'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 40px;
    cursor: pointer;
}

/* Help Text */
.form-help {
    font-size: 12px;
    color: #666;
    margin-top: 4px;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: inherit;
    min-width: 120px;
}

.btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.2);
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.btn-primary:hover:not(:disabled) {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    color: white;
}

.btn-secondary {
    background: transparent;
    color: #6b7280;
    border: 1px solid #6b7280;
}

.btn-secondary:hover {
    background: #6b7280;
    color: white;
    transform: translateY(-1px);
}

/* Button Groups */
.button-group {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    padding-top: 24px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Loading State */
.btn.loading {
    position: relative;
    color: transparent;
}

.btn.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    color: white;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .patient-form-container {
        padding: 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .form-body {
        padding: 24px 20px;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .button-group {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .form-header {
        flex-direction: column;
        text-align: center;
        gap: 8px;
    }
    
    .form-body {
        padding: 20px 16px;
    }
    
    .form-control,
    .form-select {
        padding: 10px 12px;
        font-size: 16px; /* Prevents zoom on iOS */
    }
}
</style>

<div class="patient-form-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-plus"></i>
            Add New Patient
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back to List', 
            ['action' => 'index'], 
            ['class' => 'btn btn-secondary', 'escape' => false]
        ) ?>
    </div>

    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-user-plus"></i>
            <h4>Patient Information</h4>
        </div>
        <div class="form-body">
            <?= $this->Form->create($patient, ['id' => 'patientForm']) ?>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Full Name
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->control('name', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter patient\'s full name',
                        'required' => true,
                        'label' => false
                    ]) ?>
                    <div class="form-help">Enter the patient's complete legal name</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-venus-mars"></i>
                        Gender
                    </label>
                    <?= $this->Form->control('gender', [
                        'type' => 'select',
                        'options' => [
                            'Male' => 'Male',
                            'Female' => 'Female',
                            'Other' => 'Other'
                        ],
                        'empty' => 'Select gender...',
                        'class' => 'form-select',
                        'label' => false
                    ]) ?>
                    <div class="form-help">Select the patient's gender</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-birthday-cake"></i>
                        Date of Birth
                    </label>
                    <?= $this->Form->control('dob', [
                        'type' => 'date',
                        'empty' => true,
                        'class' => 'form-control',
                        'label' => false
                    ]) ?>
                    <div class="form-help">Patient's date of birth for age calculation</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>
                        Contact Number
                    </label>
                    <?= $this->Form->control('contact_number', [
                        'type' => 'tel',
                        'class' => 'form-control',
                        'placeholder' => 'e.g., +60123456789',
                        'label' => false
                    ]) ?>
                    <div class="form-help">Primary phone number for contact</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </label>
                    <?= $this->Form->control('email', [
                        'type' => 'email',
                        'class' => 'form-control',
                        'placeholder' => 'patient@email.com',
                        'label' => false
                    ]) ?>
                    <div class="form-help">Email address for appointment notifications</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-toggle-on"></i>
                        Status
                    </label>
                    <?= $this->Form->control('status', [
                        'type' => 'select',
                        'options' => [
                            'active' => 'Active',
                            'inactive' => 'Inactive'
                        ],
                        'value' => 'active',
                        'class' => 'form-select',
                        'label' => false
                    ]) ?>
                    <div class="form-help">Current patient status in the system</div>
                </div>
            </div>

            <div class="button-group">
                <?= $this->Form->button('<i class="fas fa-save"></i> Add Patient', [
                    'class' => 'btn btn-primary',
                    'escape' => false,
                    'id' => 'submitBtn'
                ]) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-times"></i> Cancel', 
                    ['action' => 'index'], 
                    ['class' => 'btn btn-secondary', 'escape' => false]
                ) ?>
            </div>
            
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('patientForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Add loading state on form submit
    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });
    
    // Auto-focus first input
    document.querySelector('input[name="name"]').focus();
    
    // Phone number formatting
    const phoneInput = document.querySelector('input[name="contact_number"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('60')) {
                    value = '+' + value;
                } else if (!value.startsWith('+')) {
                    value = '+60' + value;
                }
            }
            e.target.value = value;
        });
    }
});
</script>