<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-edit"></i>
            <?= __('Edit Patient') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete',
                ['action' => 'delete', $patient->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id), 'class' => 'btn btn-outline-danger', 'escape' => false]
            ) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="form-card">
        <?= $this->Form->create($patient) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Personal Information</h5>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <?= $this->Form->control('name', [
                'class' => 'form-control',
                'label' => false
            ]) ?>
        </div>

        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Date of Birth</label>
                <?= $this->Form->control('dob', [
                    'type' => 'date',
                    'class' => 'form-control',
                    'label' => false,
                    'max' => date('Y-m-d')
                ]) ?>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Gender</label>
                <?= $this->Form->control('gender', [
                    'options' => ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'],
                    'class' => 'form-select',
                    'label' => false
                ]) ?>
            </div>
        </div>

        <h5 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Contact Details</h5>

        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Phone Number</label>
                <?= $this->Form->control('contact_number', [
                    'class' => 'form-control',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <?= $this->Form->control('email', [
                    'class' => 'form-control',
                    'label' => false
                ]) ?>
            </div>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <?= $this->Form->control('status', [
                'options' => ['active' => 'Active', 'inactive' => 'Inactive'],
                'class' => 'form-select',
                'label' => false
            ]) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Update Patient'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>