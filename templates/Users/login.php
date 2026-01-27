<!-- templates/Users/login.php -->
<?php
$this->assign('title', 'Login');
?>

<!-- Include Navbar -->
<?= $this->element('topbar_home') ?>

<div class="login-page min-vh-100 d-flex align-items-center justify-content-center position-relative overflow-hidden"
    style="padding-top: 80px;">

    <!-- Animated Background -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-light" style="z-index: -2;"></div>
    <div class="position-absolute top-0 end-0 w-100 h-100"
        style="background: radial-gradient(circle at 80% 20%, rgba(0,120,212,0.1) 0%, transparent 60%); z-index: -1;">
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 h-100"
        style="background: radial-gradient(circle at 20% 80%, rgba(0,255,127,0.05) 0%, transparent 60%); z-index: -1;">
    </div>

    <div class="container position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5" style="min-width: 350px; max-width: 500px;">
                <div class="card border-0 shadow-custom rounded-4 overflow-hidden backdrop-blur">
                    <div class="card-body p-5">

                        <!-- Header -->
                        <div class="text-center mb-5">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                <i class="fas fa-hospital-user fa-3x text-primary ml-1"></i>
                            </div>
                            <h2 class="fw-bold text-dark">Welcome Back</h2>
                            <p class="text-muted">Please sign in to access your dashboard</p>
                        </div>

                        <!-- Flash Messages -->
                        <?= $this->Flash->render() ?>

                        <!-- Login Form -->
                        <?= $this->Form->create(null, ['id' => 'loginForm']) ?>

                        <div class="form-floating mb-3">
                            <?= $this->Form->text('username', [
                                'class' => 'form-control bg-light border-0',
                                'placeholder' => 'Username',
                                'required' => true,
                                'id' => 'username'
                            ]) ?>
                            <label for="username">Username</label>
                        </div>

                        <div class="form-floating mb-4">
                            <?= $this->Form->password('password', [
                                'class' => 'form-control bg-light border-0',
                                'placeholder' => 'Password',
                                'required' => true,
                                'id' => 'password',
                                'value' => '' // Security
                            ]) ?>
                            <label for="password">Password</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label text-muted small" for="rememberMe">
                                    Remember This Device
                                </label>
                            </div>
                            <?= $this->Html->link('Forgot Password?', ['action' => 'forgotPassword'], ['class' => 'text-primary text-decoration-none small fw-bold']) ?>
                        </div>

                        <?= $this->Form->button('Sign In', [
                            'type' => 'submit',
                            'class' => 'btn btn-primary w-100 btn-lg rounded-pill fw-bold hover-lift shadow',
                            'id' => 'loginBtn'
                        ]) ?>

                        <?= $this->Form->end() ?>

                        <!-- Footer -->
                        <div class="text-center mt-5">
                            <p class="text-muted small mb-0">Don't have an account yet?</p>
                            <?= $this->Html->link('Create New Account', ['action' => 'register'], ['class' => 'text-primary fw-bold text-decoration-none']) ?>
                        </div>

                    </div>
                    <?php
                    // Optional decorative footer line
                    ?>
                    <div class="bg-primary h-1 w-100" style="height: 4px; opacity: 0.8;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Login Styles */
    .shadow-custom {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .backdrop-blur {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .form-control:focus {
        box-shadow: none;
        background-color: #fff !important;
        border: 1px solid #0078d4 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Button Loading State
        const form = document.getElementById('loginForm');
        const btn = document.getElementById('loginBtn');

        if (form && btn) {
            form.addEventListener('submit', function () {
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Signing In...';
                btn.style.opacity = '0.8';
                btn.style.pointerEvents = 'none';
            });
        }
    });
</script>