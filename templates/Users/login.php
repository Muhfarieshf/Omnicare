<!-- templates/Users/login.php -->
<div class="row justify-content-center" style="margin-top: 80px;">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="text-center mb-0">
                    <i class="fas fa-hospital"></i> Hospital Login
                </h4>
            </div>
            <div class="card-body p-4">
                <?= $this->Form->create(null, ['id' => 'loginForm']) ?>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <?= $this->Form->control('username', [
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter your username',
                            'required' => true,
                            'label' => false,
                            'autocomplete' => 'username'
                        ]) ?>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <?= $this->Form->control('password', [
                            'class' => 'form-control form-control-lg',
                            'placeholder' => 'Enter your password',
                            'required' => true,
                            'label' => false,
                            'autocomplete' => 'current-password'
                        ]) ?>
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                    
                    <div class="d-grid">
                        <?= $this->Form->submit('Login', [
                            'class' => 'btn btn-primary btn-lg',
                            'id' => 'loginBtn'
                        ]) ?>
                    </div>
                <?= $this->Form->end() ?>
                
                <hr class="my-4">
                
                <div class="text-center">
                    <p class="mb-2">
                        <i class="fas fa-user-plus text-success"></i> 
                        New patient? 
                        <?= $this->Html->link('Register here', ['action' => 'register'], [
                            'class' => 'text-decoration-none fw-bold text-success'
                        ]) ?>
                    </p>
                </div>
                
                <!-- Quick login buttons for testing -->
                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="text-muted mb-3">
                        <i class="fas fa-flash"></i> Quick Login (Demo)
                    </h6>
                    <div class="row g-2">
                        <div class="col-4">
                            <button class="btn btn-outline-primary btn-sm w-100 quick-login" 
                                    data-username="admin" data-password="password">
                                <i class="fas fa-user-shield"></i><br>Admin
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-outline-success btn-sm w-100 quick-login" 
                                    data-username="dr_ahmad" data-password="password">
                                <i class="fas fa-user-md"></i><br>Doctor
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-outline-info btn-sm w-100 quick-login" 
                                    data-username="john_smith" data-password="password">
                                <i class="fas fa-user"></i><br>Patient
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quick login functionality
    document.querySelectorAll('.quick-login').forEach(button => {
        button.addEventListener('click', function() {
            const username = this.dataset.username;
            const password = this.dataset.password;
            
            document.querySelector('input[name="username"]').value = username;
            document.querySelector('input[name="password"]').value = password;
            
            // Auto-submit after a brief delay
            setTimeout(() => {
                document.getElementById('loginForm').submit();
            }, 100);
        });
    });

    // Login form optimization
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    
    loginForm.addEventListener('submit', function() {
        loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
        loginBtn.disabled = true;
    });

    // Focus username field on page load
    document.querySelector('input[name="username"]').focus();
});
</script>