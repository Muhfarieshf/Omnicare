<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>

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
    max-width: 1000px;
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
    background: linear-gradient(135deg, #f59e0b, #0066cc, #f59e0b);
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
    color: #f59e0b;
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
    position: relative;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

/* Current Department Display */
.current-department {
    background: rgba(245, 158, 11, 0.05);
    border: 1px solid rgba(245, 158, 11, 0.2);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.current-department i {
    color: #f59e0b;
    font-size: 20px;
}

.current-department-text {
    color: #d97706;
    font-weight: 500;
    font-size: 14px;
}

.current-status {
    margin-left: auto;
    padding: 4px 12px;
    border-radius: 16px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.current-status.active {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.current-status.inactive {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
}

/* Form Grid */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

.form-full-width {
    grid-column: 1 / -1;
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
.form-select {
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
.form-select:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
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

/* Readonly fields styling */
.form-control[readonly] {
    background: rgba(248, 249, 250, 0.8);
    color: #666;
    cursor: not-allowed;
}

/* Changed field indicator */
.form-control.changed,
.form-select.changed {
    border-color: #f59e0b;
    background: rgba(245, 158, 11, 0.05);
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
    min-width: 140px;
}

.btn:hover {
    text-decoration: none;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
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

.btn-danger {
    background: transparent;
    color: #e11d48;
    border: 1px solid #e11d48;
}

.btn-danger:hover {
    background: #e11d48;
    color: white;
    box-shadow: 0 4px 16px rgba(225, 29, 72, 0.3);
}

/* Button Groups */
.button-group {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.additional-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-start;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Status Preview */
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
    display: flex;
    align-items: center;
    gap: 4px;
}

.status-active { 
    background: rgba(34, 197, 94, 0.1); 
    color: #22c55e; 
}

.status-inactive { 
    background: rgba(107, 114, 128, 0.1); 
    color: #6b7280; 
}

.status-badge i {
    font-size: 8px;
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

/* Required Field Indicator */
.required::after {
    content: ' *';
    color: #e11d48;
    font-weight: bold;
}

/* Change Tracking */
.change-indicator {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #f59e0b;
    color: white;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.form-group {
    position: relative;
}

/* Help Text */
.help-text {
    font-size: 12px;
    color: #666;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.help-text i {
    color: #f59e0b;
}

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
    
    .additional-actions {
        flex-direction: column;
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
    .form-select {
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
.form-select:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
}
</style>

<div class="form-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-edit"></i>
            Edit Department
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back to List',
            ['action' => 'index'],
            ['class' => 'btn btn-outline', 'escape' => false]
        ) ?>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <!-- Current Department Status -->
        <div class="current-department">
            <i class="fas fa-building"></i>
            <span class="current-department-text">
                Editing department: <strong><?= h($department->name) ?></strong>
            </span>
            <span class="current-status <?= h($department->status) ?>">
                <i class="fas fa-circle"></i>
                <?= h(ucfirst($department->status)) ?>
            </span>
        </div>

        <?= $this->Form->create($department) ?>
        
        <!-- Name and Status -->
        <div class="form-row">
            <div class="form-group">
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'label' => ['class' => 'required'],
                    'placeholder' => 'Enter department name'
                ]) ?>
                <div class="help-text">
                    <i class="fas fa-info-circle"></i>
                    Department name should be descriptive and unique
                </div>
            </div>
            
            <div class="form-group">
                <?= $this->Form->control('status', [
                    'type' => 'select',
                    'options' => [
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ],
                    'class' => 'form-select',
                    'label' => ['class' => 'required']
                ]) ?>
                <div class="status-preview">
                    <span class="status-badge status-active">
                        <i class="fas fa-circle"></i>
                        Active
                    </span>
                    <span class="status-badge status-inactive">
                        <i class="fas fa-circle"></i>
                        Inactive
                    </span>
                </div>
            </div>
        </div>

        <!-- Timestamp Fields (Read-only) -->
        <div class="form-row">
            <div class="form-group">
                <?= $this->Form->control('created_at', [
                    'class' => 'form-control',
                    'readonly' => true,
                    'value' => $department->created_at ? $department->created_at->format('Y-m-d H:i:s') : ''
                ]) ?>
                <div class="help-text">
                    <i class="fas fa-clock"></i>
                    Read-only field - automatically managed
                </div>
            </div>
            
            <div class="form-group">
                <?= $this->Form->control('updated_at', [
                    'class' => 'form-control',
                    'readonly' => true,
                    'value' => $department->updated_at ? $department->updated_at->format('Y-m-d H:i:s') : ''
                ]) ?>
                <div class="help-text">
                    <i class="fas fa-clock"></i>
                    Automatically updated when saving
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="button-group">
            <?= $this->Html->link(
                '<i class="fas fa-times"></i> Cancel',
                ['action' => 'index'],
                ['class' => 'btn btn-secondary', 'escape' => false]
            ) ?>
            <?= $this->Form->button(
                'Save Changes',
                [
                    'class' => 'btn btn-primary',
                    'type' => 'submit',
                    'escape' => false
                ]
            ) ?>
        </div>

        <!-- Additional Actions -->
        <div class="additional-actions">
            <?= $this->Html->link(
                '<i class="fas fa-eye"></i> View Department',
                ['action' => 'view', $department->id],
                ['class' => 'btn btn-outline', 'escape' => false]
            ) ?>
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete Department',
                ['action' => 'delete', $department->id],
                [
                    'confirm' => __('Are you sure you want to delete this department?'),
                    'class' => 'btn btn-danger',
                    'escape' => false
                ]
            ) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
// Enhanced Department Edit Form
document.addEventListener('DOMContentLoaded', function() {
    // Store original values for change tracking
    const formElements = document.querySelectorAll('.form-control, .form-select');
    const originalValues = {};
    
    formElements.forEach(element => {
        if (!element.readOnly) {
            originalValues[element.name] = element.value;
        }
    });
    
    // Track changes and highlight modified fields
    function trackChanges() {
        formElements.forEach(element => {
            if (!element.readOnly && element.value !== originalValues[element.name]) {
                element.classList.add('changed');
                
                // Add change indicator if not already present
                if (!element.parentElement.querySelector('.change-indicator')) {
                    const indicator = document.createElement('div');
                    indicator.className = 'change-indicator';
                    indicator.textContent = '!';
                    indicator.title = 'This field has been modified';
                    element.parentElement.appendChild(indicator);
                }
            } else {
                element.classList.remove('changed');
                
                // Remove change indicator
                const indicator = element.parentElement.querySelector('.change-indicator');
                if (indicator) {
                    indicator.remove();
                }
            }
        });
    }
    
    // Add event listeners for change tracking
    formElements.forEach(element => {
        if (!element.readOnly) {
            element.addEventListener('input', trackChanges);
            element.addEventListener('change', trackChanges);
        }
    });
    
    // Enhanced status change feedback
    const statusSelect = document.querySelector('select[name="status"]');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const badges = document.querySelectorAll('.status-badge');
            badges.forEach(badge => badge.style.opacity = '0.3');
            
            const selectedClass = this.value === 'active' ? 'status-active' : 'status-inactive';
            const selectedBadge = document.querySelector(`.${selectedClass}`);
            if (selectedBadge) {
                selectedBadge.style.opacity = '1';
                selectedBadge.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    selectedBadge.style.transform = 'scale(1)';
                }, 200);
            }
            
            // Update current status indicator
            const currentStatus = document.querySelector('.current-status');
            if (currentStatus) {
                currentStatus.className = `current-status ${this.value}`;
                currentStatus.innerHTML = `<i class="fas fa-circle"></i> ${this.value.charAt(0).toUpperCase() + this.value.slice(1)}`;
            }
        });
        
        // Trigger on page load
        statusSelect.dispatchEvent(new Event('change'));
    }
    
    // Add loading state to submit button
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('.btn-primary');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving Changes...';
        });
    }
    
    // Confirm navigation away if changes were made
    window.addEventListener('beforeunload', function(e) {
        const hasChanges = document.querySelector('.changed');
        if (hasChanges) {
            e.preventDefault();
            e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
            return e.returnValue;
        }
    });
    
    // Remove beforeunload when form is submitted
    if (form) {
        form.addEventListener('submit', function() {
            window.removeEventListener('beforeunload', arguments.callee);
        });
    }
    
    // Auto-focus first editable field
    const firstEditableField = document.querySelector('.form-control:not([readonly]):invalid, .form-select:invalid, .form-control:not([readonly])[value=""], .form-select[value=""]');
    if (firstEditableField) {
        firstEditableField.focus();
    }
    
    // Enhanced name validation
    const nameField = document.querySelector('input[name="name"]');
    if (nameField) {
        nameField.addEventListener('input', function() {
            const value = this.value.trim();
            if (value.length < 2) {
                this.style.borderColor = '#e11d48';
            } else if (value.length > 50) {
                this.style.borderColor = '#f59e0b';
            } else {
                this.style.borderColor = '#22c55e';
            }
        });
    }
    
    // Update timestamps display on form changes
    const updatedAtField = document.querySelector('input[name="updated_at"]');
    if (updatedAtField) {
        formElements.forEach(element => {
            if (!element.readOnly) {
                element.addEventListener('input', function() {
                    // Show that updated_at will be changed
                    updatedAtField.style.background = 'rgba(245, 158, 11, 0.05)';
                    updatedAtField.style.borderColor = '#f59e0b';
                });
            }
        });
    }
});
</script>