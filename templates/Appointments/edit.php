<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var string[] $patients
 * @var string[] $doctors
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-edit"></i>
            <?= __('Edit Appointment') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Html->link('<i class="fas fa-eye"></i> View', ['action' => 'view', $appointment->id], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
            <?= $this->Form->postLink(
                '<i class="fas fa-trash"></i> Delete',
                ['action' => 'delete', $appointment->id],
                ['confirm' => __('Are you sure you want to delete this appointment?'), 'class' => 'btn btn-outline-danger', 'escape' => false]
            ) ?>
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="form-card">
        <?= $this->Form->create($appointment) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Appointment Details</h5>
        
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Patient</label>
                <?= $this->Form->control('patient_id', ['options' => $patients, 'class' => 'form-select', 'label' => false]) ?>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Doctor</label>
                <?= $this->Form->control('doctor_id', ['options' => $doctors, 'class' => 'form-select', 'label' => false]) ?>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-5 mb-3">
                <label class="form-label fw-bold">Date</label>
                <?= $this->Form->control('appointment_date', ['type' => 'date', 'class' => 'form-control', 'label' => false]) ?>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Time</label>
                <?= $this->Form->control('appointment_time', ['type' => 'time', 'class' => 'form-control', 'label' => false, 'step' => 900]) ?>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Duration (min)</label>
                <?= $this->Form->control('duration_minutes', ['type' => 'number', 'class' => 'form-control', 'label' => false, 'step' => 15]) ?>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Remarks</label>
            <?= $this->Form->control('remarks', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3, 'label' => false]) ?>
        </div>

        <?php if (isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor'])): ?>
        <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <?= $this->Form->control('status', [
                'options' => [
                    'Scheduled' => 'Scheduled',
                    'Confirmed' => 'Confirmed',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                    'Cancelled' => 'Cancelled',
                    'No Show' => 'No Show',
                    'Pending Approval' => 'Pending Approval'
                ],
                'class' => 'form-select',
                'label' => false
            ]) ?>
        </div>
        <?php endif; ?>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Update Appointment'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>