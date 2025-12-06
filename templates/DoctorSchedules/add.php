<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DoctorSchedule $doctorSchedule
 * @var \Cake\Collection\CollectionInterface|string[] $doctors
 * @var array $days
 * @var \App\Model\Entity\User $user
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-calendar-plus"></i>
            <?= __('Add Schedule Slot') ?>
        </h3>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
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
                <?= $this->Form->control('start_time', [
                    'type' => 'time', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'step' => 900
                ]) ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">End Time</label>
                <?= $this->Form->control('end_time', [
                    'type' => 'time', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'step' => 900
                ]) ?>
            </div>
        </div>

        <div class="mb-3 form-check">
            <?= $this->Form->checkbox('is_available', ['id' => 'isAvailable', 'class' => 'form-check-input', 'checked' => true]) ?>
            <label class="form-check-label fw-bold" for="isAvailable">Set as Available</label>
            <div class="form-text text-muted">Uncheck if you want to explicitly block out this time slot.</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Notes (Optional)</label>
            <?= $this->Form->control('notes', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3, 'label' => false, 'placeholder' => 'e.g., Morning rounds, Walk-ins only']) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
             <?= $this->Form->button(__('Save Schedule'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>