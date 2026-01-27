<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Reset Password');
?>

<!-- Include Navbar -->
<?= $this->element('topbar_home') ?>

<div class="reset-password-page min-vh-100 d-flex align-items-center justify-content-center position-relative overflow-hidden"
    style="padding-top: 100px; padding-bottom: 50px;">

    <!-- Animated Background -->
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-light" style="z-index: -2;"></div>
    <div class="position-absolute top-0 end-0 w-100 h-100"
        style="background: radial-gradient(circle at 80% 20%, rgba(0,120,212,0.1) 0%, transparent 60%); z-index: -1;">
    </div>
    <div class="position-absolute bottom-0 start-0 w-100 h-100"
        style="background: radial-gradient(circle at 20% 80%, rgba(40,167,69,0.05) 0%, transparent 60%); z-index: -1;">
    </div>

    <div class="container position-relative z-index-1">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5" style="min-width: 350px; max-width: 500px;">
                <div class="card border-0 shadow-custom rounded-4 overflow-hidden backdrop-blur">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                <i class="fas fa-lock-open fa-2x text-success"></i>
                            </div>
                            <h4 class="fw-bold text-dark">Reset Password</h4>
                            <p class="text-muted">Create a new password for your account.</p>
                        </div>

                        <?= $this->Form->create(null, ['id' => 'resetPasswordForm']) ?>
                        <div class="form-floating mb-3">
                            <?= $this->Form->password('password', [
                                'class' => 'form-control bg-light border-0',
                                'placeholder' => 'New Password',
                                'required' => true,
                                'id' => 'password'
                            ]) ?>
                            <label for="password">New Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <?= $this->Form->password('confirm_password', [
                                'class' => 'form-control bg-light border-0',
                                'placeholder' => 'Confirm Password',
                                'required' => true,
                                'id' => 'confirm_password'
                            ]) ?>
                            <label for="confirm_password">Confirm Password</label>
                        </div>

                        <div class="d-grid gap-2">
                            <?= $this->Form->button('Update Password', [
                                'type' => 'submit',
                                'class' => 'btn btn-success btn-lg rounded-pill fw-bold hover-lift shadow'
                            ]) ?>
                        </div>
                        <?= $this->Form->end() ?>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="mb-0 text-muted small">Remember your password?</p>
                            <?= $this->Html->link(
                                'Back to Login',
                                ['action' => 'login'],
                                ['class' => 'text-primary fw-bold text-decoration-none mt-1 d-inline-block']
                            ) ?>
                        </div>
                    </div>
                    <div class="bg-success h-1 w-100" style="height: 4px; opacity: 0.8;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .shadow-custom {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .backdrop-blur {
        background: rgba(255, 255, 255, 0.95);
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
        border: 1px solid #28a745 !important;
    }
</style>