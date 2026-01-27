<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title', 'Register');
?>

<!-- Include Navbar -->
<?= $this->element('topbar_home') ?>

<div class="register-page min-vh-100 d-flex align-items-center justify-content-center position-relative overflow-hidden"
    style="padding-top: 100px; padding-bottom: 50px;">

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
            <div class="col-md-10 col-lg-8 col-xl-6" style="min-width: 400px; max-width: 700px;">
                <div class="card border-0 shadow-custom rounded-4 overflow-hidden backdrop-blur">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                                <i class="fas fa-user-plus fa-2x text-primary"></i>
                            </div>
                            <h4 class="fw-bold text-dark">Create Account</h4>
                            <p class="text-muted">Join OmniCare as a new patient</p>
                        </div>

                        <?= $this->Form->create($user) ?>
                        <h6 class="text-uppercase text-muted small fw-bold mb-3 ls-1 border-bottom pb-2">Account Details
                        </h6>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Username</label>
                            <?= $this->Form->text('username', [
                                'class' => 'form-control bg-light border-0 py-2',
                                'placeholder' => 'Choose a username',
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label small fw-bold text-muted">Password</label>
                                <?= $this->Form->password('password', [
                                    'class' => 'form-control bg-light border-0 py-2',
                                    'placeholder' => '••••••••',
                                    'required' => true
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Confirm Password</label>
                                <?= $this->Form->password('confirm_password', [
                                    'class' => 'form-control bg-light border-0 py-2',
                                    'placeholder' => '••••••••',
                                    'required' => true
                                ]) ?>
                            </div>
                        </div>

                        <h6 class="text-uppercase text-muted small fw-bold mb-3 mt-4 ls-1 border-bottom pb-2">Personal
                            Information</h6>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Full Name</label>
                            <?= $this->Form->text('name', [
                                'class' => 'form-control bg-light border-0 py-2',
                                'placeholder' => 'John Doe',
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email Address</label>
                            <?= $this->Form->email('email', [
                                'class' => 'form-control bg-light border-0 py-2',
                                'placeholder' => 'john@example.com',
                                'required' => true
                            ]) ?>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label small fw-bold text-muted">Phone Number</label>
                                <?= $this->Form->text('contact_number', [
                                    'class' => 'form-control bg-light border-0 py-2',
                                    'placeholder' => '+1 234 567 890'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Date of Birth</label>
                                <?= $this->Form->date('dob', [
                                    'class' => 'form-control bg-light border-0 py-2'
                                ]) ?>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <?= $this->Form->button('Register Now', [
                                'type' => 'submit',
                                'class' => 'btn btn-primary btn-lg rounded-pill fw-bold hover-lift glisten shadow'
                            ]) ?>
                        </div>
                        <?= $this->Form->end() ?>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="mb-0 text-muted small">Already have an account?</p>
                            <?= $this->Html->link(
                                'Sign In Instead',
                                ['action' => 'login'],
                                ['class' => 'text-primary fw-bold text-decoration-none mt-1 d-inline-block']
                            ) ?>
                        </div>
                    </div>
                    <div class="bg-primary h-1 w-100" style="height: 4px; opacity: 0.8;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styles (Shared with Login) */
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
        border: 1px solid #0078d4 !important;
    }

    .ls-1 {
        letter-spacing: 1px;
    }
</style>