<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="glass-card p-4 p-md-5">
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark">Create Account</h4>
        <p class="text-muted">Register as a new patient</p>
    </div>

    <?= $this->Form->create($user) ?>
        <h6 class="text-uppercase text-muted small fw-bold mb-3">Account Details</h6>
        
        <div class="mb-3">
            <label class="form-label">Username</label>
            <?= $this->Form->control('username', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'Choose a username',
                'required' => true
            ]) ?>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="form-label">Password</label>
                <?= $this->Form->control('password', [
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => '••••••••',
                    'required' => true
                ]) ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm Password</label>
                <?= $this->Form->control('confirm_password', [
                    'type' => 'password',
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => '••••••••',
                    'required' => true
                ]) ?>
            </div>
        </div>

        <h6 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Personal Information</h6>

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <?= $this->Form->control('name', [
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'John Doe',
                'required' => true
            ]) ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <?= $this->Form->control('email', [
                'type' => 'email',
                'label' => false,
                'class' => 'form-control',
                'placeholder' => 'john@example.com',
                'required' => true
            ]) ?>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="form-label">Phone Number</label>
                <?= $this->Form->control('contact_number', [
                    'label' => false,
                    'class' => 'form-control',
                    'placeholder' => '+1 234 567 890'
                ]) ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <?= $this->Form->control('dob', [
                    'type' => 'date',
                    'label' => false,
                    'class' => 'form-control'
                ]) ?>
            </div>
        </div>

        <div class="d-grid gap-2 mt-4">
            <?= $this->Form->button(__('Register Now'), [
                'class' => 'btn btn-primary btn-lg fw-bold'
            ]) ?>
        </div>
    <?= $this->Form->end() ?>

    <div class="text-center mt-4">
        <p class="mb-0 text-muted">Already have an account?</p>
        <?= $this->Html->link(
            'Sign In Instead',
            ['action' => 'login'],
            ['class' => 'text-decoration-none fw-bold']
        ) ?>
    </div>
</div>