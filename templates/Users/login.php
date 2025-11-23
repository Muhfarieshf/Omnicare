<!-- templates/Users/login.php -->
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



.login-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 20px;
    position: relative;
    z-index: 1;
}

.login-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 8px;
    width: 100%;
    max-width: 420px;
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

.form-control {
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

.form-control:focus {
    border-color: #0066cc;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
}

.form-control::placeholder {
    color: #666;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
}

.form-check-input {
    width: 16px;
    height: 16px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #0066cc;
    border-color: #0066cc;
}

.form-check-label {
    font-size: 14px;
    color: #1f1f1f;
    cursor: pointer;
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

.btn-primary {
    background: #0066cc;
    color: white;
    width: 100%;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.btn-primary:hover:not(:disabled) {
    background: #0052a3;
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    transform: translateY(-1px);
}

.btn-primary:disabled {
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

.register-link {
    text-align: center;
    margin-bottom: 24px;
}

.register-link a {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
}

.register-link a:hover {
    text-decoration: underline;
}

.quick-login-section {
    background: rgba(248, 249, 250, 0.8);
    border-radius: 8px;
    padding: 20px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.quick-login-title {
    font-size: 14px;
    font-weight: 500;
    color: #666;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.quick-login-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}

.btn-quick {
    padding: 12px 8px;
    font-size: 12px;
    border-radius: 6px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    background: rgba(255, 255, 255, 0.9);
    color: #1f1f1f;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}

.btn-quick:hover {
    background: rgba(255, 255, 255, 1);
    border-color: #0066cc;
    color: #0066cc;
    transform: translateY(-1px);
}

.btn-quick i {
    font-size: 16px;
}

.flash-overlay {
    position: absolute;
    top: 80px; /* Moved down to account for fixed topbar */
    left: 50%;
    transform: translateX(-50%);
    min-width: 320px;
    max-width: 90vw;
    z-index: 1040; /* Below topbar (1050) but above other content */
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

/* Ensure login/register containers have proper z-index */
.login-container,
.register-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 20px;
    position: relative;
    z-index: 1; /* Below flash overlay and topbar */
    padding-top: 80px; /* Account for fixed topbar */
}

/* For register page specifically, adjust the margin-top */
.register-container {
    margin-top: 0; 
    padding-top: 100px; 
}

/* Ensure body background stays behind everything */
body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
    z-index: -1; /* Far behind everything */
}

/* Update the card hover effect to not interfere with topbar */
.login-card:hover,
.register-card:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 8px 24px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(0, 0, 0, 0.05);
    
    z-index: 2;
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

@keyframes fadeInFlash {
    from { opacity: 0; transform: translateY(-16px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}


/* Responsive design */
@media (max-width: 480px) {
    .card-body {
        padding: 24px;
    }
    
    .quick-login-buttons {
        grid-template-columns: 1fr;
    }
}

/* Override any existing Bootstrap/framework styles only inside login card */
.login-card .row, .login-card .col-md-6, .login-card .col-lg-5 {
    all: unset;
}
</style>

<div class="login-container">
    <div class="login-card">
        <?php $flashContent = $this->Flash->render(); ?>
        <?php if (!empty(trim($flashContent))): ?>
        <div class="flash-overlay" id="flashOverlay">
            <?= $flashContent ?>
        </div>
        <?php endif; ?>
        <div class="card-header">
            <h4>
                <i class="fas fa-hospital"></i>
                Hospital Login
            </h4>
        </div>
        <div class="card-body">
            <?= $this->Form->create(null, ['id' => 'loginForm']) ?>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Username
                    </label>
                    <?= $this->Form->control('username', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your username',
                        'required' => true,
                        'label' => false,
                        'autocomplete' => 'username'
                    ]) ?>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter your password',
                        'required' => true,
                        'label' => false,
                        'autocomplete' => 'current-password'
                    ]) ?>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Remember me
                    </label>
                </div>
                
                <?= $this->Form->submit('Login', [
                    'class' => 'btn btn-primary',
                    'id' => 'loginBtn'
                ]) ?>
            <?= $this->Form->end() ?>
            
            <div class="divider">
                <span>or</span>
            </div>
            
            <div class="register-link">
                <p>
                    <i class="fas fa-user-plus" style="color: #107c10;"></i> 
                    New patient? 
                    <?= $this->Html->link('Register here', ['action' => 'register'], [
                        'class' => 'text-decoration-none fw-bold'
                    ]) ?>
                </p>
            </div>
                       
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Login form optimization
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    
    loginForm.addEventListener('submit', function() {
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
        loginBtn.disabled = true;
    });

    // Focus username field on page load
    document.querySelector('input[name="username"]').focus();

    // Add smooth focus animations
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
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