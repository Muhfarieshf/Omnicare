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
    position: relative;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(135deg, #0066cc, #004499);
}

/* New Department Notice */
.new-department-notice {
    background: rgba(0, 102, 204, 0.05);
    border: 1px solid rgba(0, 102, 204, 0.2);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.new-department-notice i {
    color: #0066cc;
    font-size: 20px;
}

.new-department-notice-text {
    color: #004499;
    font-weight: 500;
    font-size: 14px;
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

/* Auto-generated fields styling */
.form-control.auto-generated {
    background: rgba(0, 102, 204, 0.02);
    color: #666;
    cursor: not-allowed;
}

.form-control.auto-generated:focus {
    border-color: rgba(0, 102, 204, 0.3);
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.05);
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

.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    box-shadow: 0 4px 16px rgba(34, 197, 94, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
    box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    color: white;
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

/* Validation States */
.form-control.valid {
    border-color: #22c55e;
}

.form-control.invalid {
    border-color: #e11d48;
}

.form-control.warning {
    border-color: #f59e0b;
}

/* Required Field Indicator */
.required::after {
    content: ' *';
    color: #e11d48;
    font-weight: bold;
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
    color: #0066cc;
}

.help-text.auto-info {
    color: #0066cc;
}

.help-text.auto-info i {
    color: #0066cc;
}

/* Department Preview */
.department-preview {
    background: rgba(0, 102, 204, 0.02);
    border: 1px solid rgba(0, 102, 204, 0.1);
    border-radius: 8px;
    padding: 16px;
    margin-top: 16px;
    display: none;
}

.department-preview.show {
    display: block;
}

.preview-title {
    font-size: 14px;
    font-weight: 600;
    color: #0066cc;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.preview-content {
    font-size: 13px;
    color: #666;
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

/* Form Progress */
.form-progress {
    height: 2px;
    background: rgba(0, 102, 204, 0.1);
    border-radius: 1px;
    overflow: hidden;
    margin-bottom: 24px;
}

.form-progress-bar {
    height: 100%;
    background: linear-gradient(135deg, #0066cc, #004499);
    width: 0%;
    transition: width 0.3s ease;
}
</style>

<div class="form-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-plus"></i>
            Add Department
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back to List',
            ['action' => 'index'],
            ['class' => 'btn btn-outline', 'escape' => false]
        ) ?>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <!-- New Department Notice -->
        <div class="new-department-notice">
            <i class="fas fa-info-circle"></i>
            <span class="new-department-notice-text">
                Create a new department for your hospital. All required fields must be completed.
            </span>
        </div>

        <!-- Form Progress -->
        <div class="form-progress">
            <div class="form-progress-bar" id="formProgress"></div>
        </div>

        <?= $this->Form->create($department) ?>
        
        <!-- Name and Status -->
        <div class="form-row">
            <div class="form-group">
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'label' => ['class' => 'required'],
                    'placeholder' => 'Enter department name (e.g., Cardiology, Emergency)',
                    'maxlength' => 100
                ]) ?>
                <div class="help-text">
                    <i class="fas fa-info-circle"></i>
                    Enter a unique, descriptive name for the department
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
                    'label' => ['class' => 'required'],
                    'default' => 'active'
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
                <div class="help-text">
                    <i class="fas fa-lightbulb"></i>
                    New departments are typically set to "Active"
                </div>
            </div>
        </div>

        <!-- Timestamp Fields (Auto-generated) -->
        <div class="form-row">
            <div class="form-group">
                <?= $this->Form->control('created_at', [
                    'type' => 'text',
                    'class' => 'form-control auto-generated',
                    'readonly' => true,
                    'value' => 'Auto-generated when saving',
                    'placeholder' => 'Will be set automatically'
                ]) ?>
                <div class="help-text auto-info">
                    <i class="fas fa-magic"></i>
                    Automatically set to current date and time when department is created
                </div>
            </div>
            
            <div class="form-group">
                <?= $this->Form->control('updated_at', [
                    'type' => 'text',
                    'class' => 'form-control auto-generated',
                    'readonly' => true,
                    'value' => 'Auto-generated when saving',
                    'placeholder' => 'Will be set automatically'
                ]) ?>
                <div class="help-text auto-info">
                    <i class="fas fa-magic"></i>
                    Automatically updated whenever the department is modified
                </div>
            </div>
        </div>

        <!-- Department Preview -->
        <div class="department-preview" id="departmentPreview">
            <div class="preview-title">
                <i class="fas fa-eye"></i>
                Department Preview
            </div>
            <div class="preview-content" id="previewContent">
                <!-- Dynamic preview content -->
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
                'Add Department',
                [
                    'class' => 'btn btn-primary',
                    'type' => 'submit',
                    'escape' => false,
                    'id' => 'submitBtn'
                ]
            ) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
// Enhanced Add Department Form
document.addEventListener('DOMContentLoaded', function() {
    const nameField = document.querySelector('input[name="name"]');
    const statusField = document.querySelector('select[name="status"]');
    const departmentPreview = document.getElementById('departmentPreview');
    const previewContent = document.getElementById('previewContent');
    const formProgress = document.getElementById('formProgress');
    const submitBtn = document.getElementById('submitBtn');
    
    // Form completion tracking
    function updateFormProgress() {
        let completedFields = 0;
        let totalFields = 2; // name and status
        
        if (nameField && nameField.value.trim().length >= 2) {
            completedFields++;
        }
        if (statusField && statusField.value) {
            completedFields++;
        }
        
        const progress = (completedFields / totalFields) * 100;
        formProgress.style.width = progress + '%';
        
        // Enable/disable submit button
        if (submitBtn) {
            submitBtn.disabled = progress < 100;
        }
    }
    
    // Real-time department preview
    function updateDepartmentPreview() {
        const name = nameField ? nameField.value.trim() : '';
        const status = statusField ? statusField.value : 'active';
        
        if (name.length >= 2) {
            const statusText = status.charAt(0).toUpperCase() + status.slice(1);
            const statusClass = status === 'active' ? 'status-active' : 'status-inactive';
            
            previewContent.innerHTML = `
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                    <strong style="font-size: 16px;">${name}</strong>
                    <span class="status-badge ${statusClass}">
                        <i class="fas fa-circle"></i>
                        ${statusText}
                    </span>
                </div>
                <div style="font-size: 12px; color: #666;">
                    This department will be ${status} and available for doctor assignments.
                </div>
            `;
            departmentPreview.classList.add('show');
        } else {
            departmentPreview.classList.remove('show');
        }
    }
    
    // Name field validation
    if (nameField) {
        nameField.addEventListener('input', function() {
            const value = this.value.trim();
            
            // Remove previous validation classes
            this.classList.remove('valid', 'invalid', 'warning');
            
            if (value.length === 0) {
                // No styling for empty
            } else if (value.length < 2) {
                this.classList.add('invalid');
            } else if (value.length > 50) {
                this.classList.add('warning');
            } else {
                this.classList.add('valid');
            }
            
            updateFormProgress();
            updateDepartmentPreview();
        });
        
        // Auto-capitalize first letter
        nameField.addEventListener('blur', function() {
            if (this.value) {
                this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
                updateDepartmentPreview();
            }
        });
    }
    
    // Status field handling
    if (statusField) {
        statusField.addEventListener('change', function() {
            // Highlight selected status badge
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
            
            updateFormProgress();
            updateDepartmentPreview();
        });
        
        // Trigger initial status highlighting
        statusField.dispatchEvent(new Event('change'));
    }
    
    // Form submission handling
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate required fields
            if (!nameField.value.trim() || nameField.value.trim().length < 2) {
                e.preventDefault();
                nameField.focus();
                nameField.classList.add('invalid');
                return false;
            }
            
            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Creating Department...';
            }
        });
    }
    
    // Auto-focus name field
    if (nameField) {
        nameField.focus();
    }
    
    // Initialize form state
    updateFormProgress();
    
    // Department name suggestions
    const nameFieldContainer = nameField ? nameField.parentElement : null;
    if (nameFieldContainer) {
        const suggestions = [
            'Emergency', 'Cardiology', 'Neurology', 'Orthopedics', 
            'Pediatrics', 'Radiology', 'Laboratory', 'Surgery',
            'Internal Medicine', 'Dermatology', 'Psychiatry', 'Oncology'
        ];
        
        const suggestionsDiv = document.createElement('div');
        suggestionsDiv.style.cssText = `
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid rgba(0, 102, 204, 0.2);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        `;
        
        nameField.addEventListener('input', function() {
            const value = this.value.toLowerCase();
            if (value.length >= 1) {
                const matches = suggestions.filter(s => 
                    s.toLowerCase().includes(value) && s.toLowerCase() !== value
                );
                
                if (matches.length > 0) {
                    suggestionsDiv.innerHTML = matches.map(suggestion => 
                        `<div style="padding: 8px 12px; cursor: pointer; border-bottom: 1px solid #f0f0f0;" 
                              onmouseover="this.style.background='rgba(0,102,204,0.05)'" 
                              onmouseout="this.style.background=''"
                              onclick="document.querySelector('input[name=name]').value='${suggestion}'; this.parentElement.style.display='none'; document.querySelector('input[name=name]').dispatchEvent(new Event('input'));">
                            ${suggestion}
                        </div>`
                    ).join('');
                    suggestionsDiv.style.display = 'block';
                } else {
                    suggestionsDiv.style.display = 'none';
                }
            } else {
                suggestionsDiv.style.display = 'none';
            }
        });
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!nameFieldContainer.contains(e.target)) {
                suggestionsDiv.style.display = 'none';
            }
        });
        
        nameFieldContainer.style.position = 'relative';
        nameFieldContainer.appendChild(suggestionsDiv);
    }
});
</script>