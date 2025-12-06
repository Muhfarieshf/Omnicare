<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DoctorSchedule $doctorSchedule
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-edit"></i>
            <?= __('Edit Schedule Slot') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete Slot',
                ['action' => 'delete', $doctorSchedule->id],
                ['confirm' => __('Are you sure you want to delete this schedule slot?'), 'class' => 'btn btn-outline-danger', 'escape' => false]
            ) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="form-card">
        <?= $this->Form->create($doctorSchedule) ?>
        
        <?php if ($user->role === 'admin'): ?>
        <div class="mb-3">
            <label class="form-label fw-bold">Doctor</label>
            <?= $this->Form->control('doctor_id', ['options' => $doctors, 'class' => 'form-select', 'label' => false]) ?>
        </div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label fw-bold">Day of Week</label>
            <?= $this->Form->control('day_of_week', ['options' => $days, 'class' => 'form-select', 'label' => false]) ?>
        </div>

        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Start Time</label>
                <?= $this->Form->control('start_time', ['class' => 'form-control', 'label' => false, 'step' => 900]) ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">End Time</label>
                <?= $this->Form->control('end_time', ['class' => 'form-control', 'label' => false, 'step' => 900]) ?>
            </div>
        </div>

        <div class="mb-3 form-check">
            <?= $this->Form->checkbox('is_available', ['id' => 'isAvailable', 'class' => 'form-check-input']) ?>
            <label class="form-check-label fw-bold" for="isAvailable">Set as Available</label>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Notes</label>
            <?= $this->Form->control('notes', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3, 'label' => false]) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Update Schedule'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>