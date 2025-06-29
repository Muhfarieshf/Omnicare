<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.users-form-container {
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
    .users-form-container {
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

<div class="users-form-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-user-plus"></i>
            Add New User
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back to List', 
            ['action' => 'index'], 
            ['class' => 'btn btn-secondary', 'escape' => false]
        ) ?>
    </div>

    <div class="form-card">
        <div class="form-header">
            <i class="fas fa-user-circle"></i>
            <h4>User Account Information</h4>
        </div>
        <div class="form-body">
            <?= $this->Form->create($user, ['id' => 'userForm']) ?>
            
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Username
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->control('username', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter a username',
                        'required' => true,
                        'label' => false
                    ]) ?>
                    <div class="form-help">The unique username for the user account.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>
                        Password
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter a strong password',
                        'required' => true,
                        'label' => false
                    ]) ?>
                    <div class="form-help">Use a mix of letters, numbers, and symbols.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user-tag"></i>
                        Role
                        <span class="required">*</span>
                    </label>
                    <?= $this->Form->control('role', [
                        'class' => 'form-select',
                        'required' => true,
                        'label' => false
                    ]) ?>
                    <div class="form-help">Assign the user's role and permissions.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-toggle-on"></i>
                        Status
                    </label>
                    <?= $this->Form->control('status', [
                        'class' => 'form-select',
                        'label' => false
                    ]) ?>
                    <div class="form-help">Set the user account status (e.g., active, disabled).</div>
                </div>
            </div>

            <div class="button-group">
                <?= $this->Form->button('<i class="fas fa-plus-circle"></i> Add User', [
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
    const form = document.getElementById('userForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Add loading state on form submit
    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });
    
    // Auto-focus first input
    document.querySelector('input[name="username"]').focus();
});
</script>