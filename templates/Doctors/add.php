<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-plus"></i>
            <?= __('Add New Doctor') ?>
        </h3>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
    </div>

    <div class="form-card">
        <?= $this->Form->create($doctor) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Professional Details</h5>
        
        <div class="row g-3">
            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., Dr. Sarah Smith',
                    'label' => false
                ]) ?>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Department</label>
                <?= $this->Form->control('department_id', [
                    'options' => $departments,
                    'class' => 'form-select',
                    'empty' => 'Select Department...',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Status</label>
                <?= $this->Form->control('status', [
                    'options' => ['active' => 'Active', 'inactive' => 'Inactive'],
                    'class' => 'form-select',
                    'label' => false,
                    'value' => 'active'
                ]) ?>
            </div>
        </div>

        <h5 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Contact Information</h5>

        <div class="mb-3">
            <label class="form-label fw-bold">Email Address</label>
            <?= $this->Form->control('email', [
                'class' => 'form-control',
                'placeholder' => 'doctor@hospital.com',
                'label' => false
            ]) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Save Doctor'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>