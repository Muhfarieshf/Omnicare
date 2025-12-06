<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var string[]|\Cake\Collection\CollectionInterface $patients
 * @var string[]|\Cake\Collection\CollectionInterface $doctors
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-cog"></i>
            <?= __('Edit User') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete',
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-outline-danger', 'escape' => false]
            ) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="form-card">
        <?= $this->Form->create($user) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Account Credentials</h5>
        
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Username</label>
                <?= $this->Form->control('username', [
                    'class' => 'form-control',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Password</label>
                <?= $this->Form->control('password', [
                    'class' => 'form-control',
                    'placeholder' => 'Leave blank to keep unchanged',
                    'label' => false,
                    'value' => '' // Prevent auto-filling hashed password
                ]) ?>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Email</label>
                <?= $this->Form->control('email', [
                    'class' => 'form-control',
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
                    'label' => false
                ]) ?>
            </div>
        </div>
        
        <?php if ($user->role === 'doctor' || $user->role === 'patient'): ?>
        <h5 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Profile Links</h5>
        <div class="row g-3">
             <?php if ($user->role === 'patient'): ?>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Linked Patient Profile</label>
                    <?= $this->Form->control('patient_id', [
                        'options' => $patients,
                        'class' => 'form-select',
                        'empty' => 'No Profile Linked',
                        'label' => false
                    ]) ?>
                </div>
            <?php endif; ?>

            <?php if ($user->role === 'doctor'): ?>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Linked Doctor Profile</label>
                    <?= $this->Form->control('doctor_id', [
                        'options' => $doctors,
                        'class' => 'form-select',
                        'empty' => 'No Profile Linked',
                        'label' => false
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Update User'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>