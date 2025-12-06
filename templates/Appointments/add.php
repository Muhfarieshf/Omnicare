<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 * @var \Cake\Collection\CollectionInterface|string[] $patients
 * @var \Cake\Collection\CollectionInterface|string[] $doctors
 * @var array $doctorsWithDept
 * @var \App\Model\Entity\User $currentUser
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-calendar-plus"></i>
            <?= __('Book Appointment') ?>
        </h3>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
    </div>

    <div class="form-card">
        <?= $this->Form->create($appointment) ?>
        
        <h5 class="text-uppercase text-muted small fw-bold mb-4">Appointment Details</h5>

        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Patient</label>
                <?php if (isset($currentUser) && $currentUser->role === 'patient'): ?>
                    <div class="form-control bg-light text-muted">
                        <i class="fas fa-user me-2"></i> <?= h($currentUser->username) ?>
                        <?= $this->Form->hidden('patient_id', ['value' => $currentUser->patient_id]) ?>
                    </div>
                <?php else: ?>
                    <?= $this->Form->control('patient_id', [
                        'options' => $patients,
                        'class' => 'form-select',
                        'empty' => 'Select Patient...',
                        'label' => false
                    ]) ?>
                <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Doctor</label>
                <?= $this->Form->control('doctor_id', [
                    'options' => $doctors,
                    'class' => 'form-select',
                    'empty' => 'Select Doctor...',
                    'label' => false,
                    'id' => 'doctor_id'
                ]) ?>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-5 mb-3">
                <label class="form-label fw-bold">Date</label>
                <?= $this->Form->control('appointment_date', [
                    'type' => 'date',
                    'class' => 'form-control',
                    'label' => false,
                    'id' => 'appointment_date',
                    'min' => date('Y-m-d')
                ]) ?>
            </div>
            
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Time</label>
                <?= $this->Form->control('appointment_time', [
                    'type' => 'time',
                    'class' => 'form-control',
                    'label' => false,
                    'id' => 'appointment_time',
                    'step' => 900 // 15 min intervals
                ]) ?>
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label fw-bold">Duration (min)</label>
                <?= $this->Form->control('duration_minutes', [
                    'type' => 'number',
                    'class' => 'form-control',
                    'label' => false,
                    'value' => 30,
                    'min' => 15,
                    'step' => 15,
                    'id' => 'duration_minutes'
                ]) ?>
            </div>
        </div>

        <div id="conflict-message" class="alert alert-danger mt-2" style="display: none;"></div>
        
        <div id="available-slots" class="mt-3 p-3 bg-light rounded border" style="display: none;">
            </div>

        <div id="waiting-list-prompt" class="alert alert-warning mt-3 d-flex justify-content-between align-items-center" style="display: none;">
            <div>
                <strong>No slots available.</strong> All appointments for this date are booked.
            </div>
            <a id="join-waiting-list-btn" href="#" class="btn btn-sm btn-primary">
                Join Waiting List
            </a>
        </div>

        <div id="alternative-doctors" class="mt-3" style="display: none;">
            </div>

        <div class="mb-3 mt-4">
            <label class="form-label fw-bold">Remarks / Symptoms</label>
            <?= $this->Form->control('remarks', [
                'type' => 'textarea',
                'class' => 'form-control',
                'rows' => 3,
                'placeholder' => 'Briefly describe the reason for visit...',
                'label' => false
            ]) ?>
        </div>

        <?php if (isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor'])): ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <?= $this->Form->control('status', [
                    'options' => [
                        'Scheduled' => 'Scheduled',
                        'Confirmed' => 'Confirmed',
                        'Pending Approval' => 'Pending Approval'
                    ],
                    'class' => 'form-select',
                    'label' => false,
                    'value' => 'Scheduled'
                ]) ?>
            </div>
        <?php else: ?>
            <?= $this->Form->hidden('status', ['value' => 'Pending Approval']) ?>
        <?php endif; ?>

        <div class="border-top pt-3 mt-4 text-end">
            <?= $this->Form->button(__('Book Appointment'), ['class' => 'btn btn-primary']) ?>
        </div>
        
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('.btn-primary');
    const doctorSelect = document.getElementById('doctor_id');
    const dateInput = document.getElementById('appointment_date');
    const timeInput = document.getElementById('appointment_time');
    const durationInput = document.getElementById('duration_minutes');
    
    // UI Elements
    const conflictMessage = document.getElementById('conflict-message');
    const availableSlotsDiv = document.getElementById('available-slots');
    const alternative