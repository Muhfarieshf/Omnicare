<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>

<div class="form-container" style="max-width: 600px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-edit"></i>
            <?= __('Edit Department') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete',
                ['action' => 'delete', $department->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $department->id), 'class' => 'btn btn-outline-danger', 'escape' => false]
            ) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="form-card">
        <?= $this->Form->create($department) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Department Details</h5>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Department Name</label>
            <?= $this->Form->control('name', [
                'class' => 'form-control',
                'label' => false
            ]) ?>
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
            <?= $this->Form->button(__('Update Department'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>