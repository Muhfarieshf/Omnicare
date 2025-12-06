<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $patients
 * @var \Cake\Collection\CollectionInterface|string[] $doctors
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-plus"></i>
            <?= __('Add New User') ?>
        </h3>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
    </div>

    <div class="form-card">
        <?= $this->Form->create($user) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Account Credentials</h5>
        
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Username</label>
                <?= $this->Form->control('username', [
                    'class' => 'form-control',
                    'placeholder' => 'Choose a username',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password</label>
                <?= $this->Form->control('password', [
                    'class' => 'form-control',
                    'placeholder' => 'Set a password',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Email</label>
                <?= $this->Form->control('email', [
                    'class' => 'form-control',
                    'placeholder' => 'user@example.com',
                    'label' => false
                ]) ?>
            </div>
        </div>

        <h5 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Role & Permissions</h5>

        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Role</label>
                <?= $this->Form->control('role', [
                    'options' => ['admin' => 'Admin', 'doctor' => 'Doctor', 'patient' => 'Patient', 'staff' => 'Staff'],
                    'class' => 'form-select',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Status</label>
                <?= $this->Form->control('status', [
                    'options' => ['active' => 'Active', 'inactive' => 'Inactive', 'suspended' => 'Suspended'],
                    'class' => 'form-select',
                    'label' => false,
                    'value' => 'active'
                ]) ?>
            </div>
        </div>
        
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle me-2"></i> Note: Linking this user to a specific Doctor or Patient profile happens automatically based on matching email/details, or can be done manually later.
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Create User'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>