<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 * @var string[]|\Cake\Collection\CollectionInterface $departments
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-edit"></i>
            <?= __('Edit Doctor') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete',
                ['action' => 'delete', $doctor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $doctor->id), 'class' => 'btn btn-outline-danger', 'escape' => false]
            ) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="form-card">
        <?= $this->Form->create($doctor) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Professional Details</h5>
        
        <div class="row g-3">
            <div class="col-md-12 mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <?= $this->Form->control('name', [
                    'class' => 'form-control',
                    'label' => false
                ]) ?>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Department</label>
                <?= $this->Form->control('department_id', [
                    'options' => $departments,
                    'class' => 'form-select',
                    'label' => false
                ]) ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Status</label>
                <?= $this->Form->control('status', [
                    'options' => ['active' => 'Active', 'inactive' => 'Inactive'],
                    'class' => 'form-select',
                    'label' => false
                ]) ?>
            </div>
        </div>

        <h5 class="text-uppercase text-muted small fw-bold mb-3 mt-4">Contact Information</h5>

        <div class="mb-3">
            <label class="form-label fw-bold">Email Address</label>
            <?= $this->Form->control('email', [
                'class' => 'form-control',
                'label' => false
            ]) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Update Doctor'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>