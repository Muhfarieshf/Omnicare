<!-- templates/Users/register.php -->
<?php
echo $this->element('topbar_home');
?>
<div style="height:56px;"></div>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #fff;
    min-height: 100vh;
    color: #1f1f1f;
    overflow-x: hidden;
    margin: 0;
    padding: 0;
}



.register-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 20px;
    position: relative;
    z-index: 1;
    margin-top: 0; /* Remove margin, use padding-top for topbar */
    padding-top: 100px; /* Match login page's spacing for topbar */
}

.register-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 8px;
    width: 100%;
    max-width: 600px;
    box-shadow: 
        0 2px 8px rgba(0, 0, 0, 0.05),
        0 0 0 1px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}


.card-header {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    color: #1f1f1f;
    padding: 24px;
    text-align: center;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.card-header h4 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: #1f1f1f;
}

.card-header i {
    font-size: 20px;
    color: #0066cc;
}

.card-body {
    padding: 32px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
}

.form-row.single {
    grid-template-columns: 1fr;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #1f1f1f;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-control, .form-select {
    width: 100%;
    padding: 12px 16px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.8);
    transition: all 0.2s ease;
    outline: none;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
    color: #1f1f1f;
}

.form-control:focus, .form-select:focus {
    border-color: #0066cc;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
}

.form-control::placeholder {
    color: #666;
}

.form-select {
    cursor: pointer;
}

.form-select option {
    background: white;
    color: #1f1f1f;
}

.btn {
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    text-decoration: none;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
}

.btn-success {
    background: #107c10;
    color: white;
    width: 100%;
    box-shadow: 0 2px 8px rgba(16, 124, 16, 0.2);
}

.btn-success:hover:not(:disabled) {
    background: #0e6b0e;
    box-shadow: 0 4px 12px rgba(16, 124, 16, 0.3);
    transform: translateY(-1px);
}

.btn-success:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.divider {
    margin: 24px 0;
    text-align: center;
    position: relative;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: rgba(0, 0, 0, 0.1);
}

.divider span {
    background: rgba(255, 255, 255, 0.9);
    padding: 0 16px;
    color: #666;
    font-size: 14px;
}

.login-link {
    text-align: center;
    margin-top: 24px;
}

.login-link a {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
}

.login-link a:hover {
    text-decoration: underline;
}

.password-strength {
    margin-top: 8px;
    font-size: 12px;
}

.strength-indicator {
    height: 4px;
    border-radius: 2px;
    margin: 4px 0;
    transition: all 0.3s ease;
}

.strength-weak { background: #d73a49; }
.strength-medium { background: #f9c513; }
.strength-strong { background: #28a745; }

.password-match {
    margin-top: 8px;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.password-match.valid {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.password-match.invalid {
    background: rgba(215, 58, 73, 0.1);
    color: #d73a49;
}

/* Animation for form elements */


/* Glassmorphic flash overlay for Windows 11 mood */
/* Flash overlay matches login page */
.flash-overlay {
    position: absolute;
    top: 80px;
    left: 50%;
    transform: translateX(-50%);
    min-width: 320px;
    max-width: 90vw;
    z-index: 1040;
    background: rgba(255,255,255,0.85);
    border-radius: 16px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    border: 1.5px solid rgba(0,102,204,0.18);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    padding: 18px 28px 18px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 1rem;
    color: #1f1f1f;
    margin-bottom: 16px;
    animation: fadeInFlash 0.5s cubic-bezier(.4,0,.2,1);
}
.flash-overlay .alert {
    background: transparent !important;
    border: none !important;
    margin: 0;
    padding: 0;
    color: inherit;
    box-shadow: none;
}
.flash-overlay .alert-success { border-left: 4px solid #22c55e; }
.flash-overlay .alert-danger { border-left: 4px solid #e11d48; }
.flash-overlay .alert-info { border-left: 4px solid #0066cc; }
.flash-overlay .alert-warning { border-left: 4px solid #f59e42; }




/* Responsive design */
@media (max-width: 480px) {
    .card-body {
        padding: 24px;
    }
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
}

/* Override any existing Bootstrap/framework styles only inside register card */
.register-card .row, .register-card .col-md-6, .register-card .col-md-8, .register-card .col-lg-6 {
    all: unset;
}

.register-card .mb-3, .register-card .mt-3, .register-card .d-grid {
    all: unset;
}
</style>

<div class="register-container">
    <div class="register-card">
        <?php $flashContent = $this->Flash->render(); ?>
        <?php if (!empty(trim($flashContent))): ?>
        <div class="flash-overlay" id="flashOverlay">
            <?= $flashContent ?>
        </div>
        <?php endif; ?>
        <div class="card-header">
            <h4>
                <i class="fas fa-user-plus"></i>
                Patient Registration
            </h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create() ?>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>
                            First Name
                        </label>
                        <?= $this->Form->control('first_name', [
                            'class' => 'form-control',
                            'placeholder' => 'First Name',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>
                            Last Name
                        </label>
                        <?= $this->Form->control('last_name', [
                            'class' => 'form-control',
                            'placeholder' => 'Last Name',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-at"></i>
                            Username
                        </label>
                        <?= $this->Form->control('username', [
                            'class' => 'form-control',
                            'placeholder' => 'Choose a username',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </label>
                        <?= $this->Form->control('email', [
                            'type' => 'email',
                            'class' => 'form-control',
                            'placeholder' => 'your.email@example.com',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            Password
                        </label>
                        <?= $this->Form->control('password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Choose a strong password',
                            'required' => true,
                            'label' => false,
                            'minlength' => 6,
                            'id' => 'password'
                        ]) ?>
                        <div id="password-strength" class="password-strength" style="display: none;">
                            <div class="strength-indicator"></div>
                            <span class="strength-text"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>
                            Confirm Password
                        </label>
                        <?= $this->Form->control('confirm_password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Confirm your password',
                            'required' => true,
                            'label' => false,
                            'id' => 'confirm-password'
                        ]) ?>
                        <div id="password-match" class="password-match" style="display: none;"></div>
                    </div>
                </div>
                
                <div class="form-row">
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
                            'empty' => 'Select Gender',
                            'class' => 'form-select',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i>
                            Date of Birth
                        </label>
                        <?= $this->Form->control('dob', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
                
                <div class="form-row single">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>
                            Contact Number
                        </label>
                        <?= $this->Form->control('contact_number', [
                            'class' => 'form-control',
                            'placeholder' => 'Your phone number',
                            'required' => true,
                            'label' => false
                        ]) ?>
                    </div>
                </div>
                
                <?= $this->Form->submit('Register', [
                    'class' => 'btn btn-success',
                    'id' => 'registerBtn'
                ]) ?>
            <?= $this->Form->end() ?>
            
            <div class="login-link">
                <p>Already have an account? 
                    <?= $this->Html->link('Login here', ['action' => 'login'], [
                        'class' => 'text-decoration-none'
                    ]) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm-password');
    const passwordStrength = document.querySelector('#password-strength');
    const strengthIndicator = passwordStrength.querySelector('.strength-indicator');
    const strengthText = passwordStrength.querySelector('.strength-text');
    const passwordMatch = document.querySelector('#password-match');
    const registerBtn = document.querySelector('#registerBtn');
    const form = document.querySelector('form');

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = [];

        if (password.length >= 8) strength += 1;
        else feedback.push('At least 8 characters');

        if (/[a-z]/.test(password)) strength += 1;
        else feedback.push('Lowercase letter');

        if (/[A-Z]/.test(password)) strength += 1;
        else feedback.push('Uppercase letter');

        if (/[0-9]/.test(password)) strength += 1;
        else feedback.push('Number');

        if (/[^A-Za-z0-9]/.test(password)) strength += 1;
        else feedback.push('Special character');

        return { strength, feedback };
    }

    // Update password strength indicator
    function updatePasswordStrength() {
        const pwd = password.value;
        if (pwd.length === 0) {
            passwordStrength.style.display = 'none';
            return;
        }

        passwordStrength.style.display = 'block';
        const { strength, feedback } = checkPasswordStrength(pwd);

        // Update indicator
        strengthIndicator.className = 'strength-indicator';
        if (strength <= 2) {
            strengthIndicator.classList.add('strength-weak');
            strengthText.textContent = 'Weak - Missing: ' + feedback.join(', ');
        } else if (strength <= 3) {
            strengthIndicator.classList.add('strength-medium');
            strengthText.textContent = 'Medium - Missing: ' + feedback.join(', ');
        } else {
            strengthIndicator.classList.add('strength-strong');
            strengthText.textContent = 'Strong password!';
        }
    }

    // Validate password confirmation
    function validatePasswordMatch() {
        const pwd = password.value;
        const confirmPwd = confirmPassword.value;

        if (confirmPwd.length === 0) {
            passwordMatch.style.display = 'none';
            confirmPassword.setCustomValidity('');
            return;
        }

        passwordMatch.style.display = 'block';
        
        if (pwd === confirmPwd) {
            passwordMatch.className = 'password-match valid';
            passwordMatch.innerHTML = '<i class="fas fa-check"></i> Passwords match!';
            confirmPassword.setCustomValidity('');
        } else {
            passwordMatch.className = 'password-match invalid';
            passwordMatch.innerHTML = '<i class="fas fa-times"></i> Passwords do not match';
            confirmPassword.setCustomValidity('Passwords do not match');
        }
    }

    // Event listeners
    password.addEventListener('input', updatePasswordStrength);
    password.addEventListener('input', validatePasswordMatch);
    confirmPassword.addEventListener('input', validatePasswordMatch);

    // Form submission handling
    form.addEventListener('submit', function(e) {
        registerBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating account...';
        registerBtn.disabled = true;
    });

    // Focus first field on page load
    document.querySelector('input[name="first_name"]').focus();

    // Add smooth focus animations
    document.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    // Phone number formatting (basic)
    const phoneInput = document.querySelector('input[name="contact_number"]');
    phoneInput.addEventListener('input', function() {
        // Remove non-numeric characters
        let value = this.value.replace(/\D/g, '');
        
        // Limit to reasonable phone number length
        if (value.length > 15) {
            value = value.substring(0, 15);
        }
        
        this.value = value;
    });

    // Fade out flash overlay after 5 seconds
    const flash = document.getElementById('flashOverlay');
    if (flash && flash.innerText.trim() !== '') {
        setTimeout(() => {
            flash.style.transition = 'opacity 0.7s cubic-bezier(.4,0,.2,1)';
            flash.style.opacity = '0';
            setTimeout(() => flash.style.display = 'none', 800);
        }, 5000);
    }
});
</script>