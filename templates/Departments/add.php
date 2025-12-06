<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>

<div class="form-container" style="max-width: 600px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-building"></i>
            <?= __('Add Department') ?>
        </h3>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
    </div>

    <div class="form-card">
        <?= $this->Form->create($department) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Department Details</h5>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Department Name</label>
            <?= $this->Form->control('name', [
                'class' => 'form-control',
                'placeholder' => 'e.g., Cardiology',
                'label' => false
            ]) ?>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <?= $this->Form->control('status', [
                'options' => ['active' => 'Active', 'inactive' => 'Inactive'],
                'class' => 'form-select',
                'label' => false,
                'value' => 'active'
            ]) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Save Department'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>