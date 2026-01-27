<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 */
?>

<div class="view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-calendar-check"></i>
            Appointment Details
        </h3>
        <div class="header-actions">
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Information</h5>
                    <span
                        class="status-badge badge-<?= strtolower(str_replace(' ', '-', $appointment->status ?? 'scheduled')) ?>">
                        <?= h($appointment->status) ?>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 150px;">ID:</th>
                            <td>#<?= $this->Number->format($appointment->id) ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Patient:</th>
                            <td>
                                <?= $appointment->has('patient') ?
                                    $this->Html->link($appointment->patient->name, ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id]) : 'Unknown' ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0">Doctor:</th>
                            <td>
                                <?= $appointment->has('doctor') ?
                                    $this->Html->link($appointment->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id]) : 'Unknown' ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0">Date & Time:</th>
                            <td class="fw-bold text-primary">
                                <?= h($appointment->appointment_date->format('M d, Y')) ?> at
                                <?= h($appointment->appointment_time->format('h:i A')) ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0">Duration:</th>
                            <td><?= h($appointment->duration_minutes) ?> minutes</td>
                        </tr>
                        <tr>
                            <th class="ps-0">Remarks:</th>
                            <td><?= h($appointment->remarks ?: 'No remarks provided.') ?></td>
                        </tr>
                    </table>

                    <?php if ($appointment->cancellation_reason): ?>
                        <div class="alert alert-danger mt-3">
                            <strong>Cancellation Reason:</strong><br>
                            <?= h($appointment->cancellation_reason) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($statusHistory)): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Status History</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Status</th>
                                        <th>Changed By</th>
                                        <th>Date</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($statusHistory as $history): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <span class="badge bg-secondary"><?= h($history->new_status) ?></span>
                                            </td>
                                            <td><?= h($history->changedByUser->username ?? 'System') ?></td>
                                            <td><?= h($history->changed_at->format('M d, Y H:i')) ?></td>
                                            <td><?= h($history->notes) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body d-grid gap-2">
                    <?php if (isset($allowedTransitions) && !empty($allowedTransitions)): ?>
                        <div class="workflow-actions mb-3 pb-3 border-bottom">
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Change Status:</h6>

                            <?php if (in_array('Confirmed', $allowedTransitions)): ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-check-circle me-1"></i> Confirm',
                                    ['action' => 'confirm', $appointment->id],
                                    ['class' => 'btn btn-info w-100 mb-2', 'escape' => false, 'confirm' => 'Are you sure you want to confirm this appointment?']
                                ) ?>
                            <?php endif; ?>

                            <?php if (in_array('In Progress', $allowedTransitions)): ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-play me-1"></i> Start Appointment',
                                    ['action' => 'start', $appointment->id],
                                    ['class' => 'btn btn-primary w-100 mb-2', 'escape' => false, 'confirm' => 'Start this appointment now?']
                                ) ?>
                            <?php endif; ?>

                            <?php if (in_array('Completed', $allowedTransitions)): ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-check-double me-1"></i> Complete',
                                    ['action' => 'complete', $appointment->id],
                                    ['class' => 'btn btn-success w-100 mb-2', 'escape' => false, 'confirm' => 'Mark as completed?']
                                ) ?>
                            <?php endif; ?>

                            <?php
                            // Handle Cancellation variations
                            if (in_array('Cancelled', $allowedTransitions) || in_array('Pending Approval', $allowedTransitions)):
                                $action = in_array('Pending Approval', $allowedTransitions) ? 'requestCancellation' : 'cancel';
                                $btnText = $action === 'requestCancellation' ? 'Request Cancellation' : 'Cancel Appointment';
                                ?>
                                <button type="button" class="btn btn-outline-danger w-100 mb-2" data-bs-toggle="modal"
                                    data-bs-target="#cancellationModal">
                                    <i class="fas fa-times me-1"></i> <?= $btnText ?>
                                </button>
                            <?php endif; ?>

                            <?php if (isset($appointment->status) && $appointment->status === 'Pending Approval' && isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor'])): ?>
                                <div class="d-flex gap-2 mb-2">
                                    <?= $this->Form->postLink(
                                        '<i class="fas fa-check me-1"></i> Approve',
                                        ['action' => 'approveCancellation', $appointment->id],
                                        ['class' => 'btn btn-success flex-grow-1', 'escape' => false, 'confirm' => 'Approve cancellation?']
                                    ) ?>

                                    <button type="button" class="btn btn-danger flex-grow-1" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal">
                                        <i class="fas fa-times me-1"></i> Reject
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor'])): ?>
                        <?= $this->Html->link(
                            '<i class="fas fa-edit me-2"></i> Edit Details',
                            ['action' => 'edit', $appointment->id],
                            ['class' => 'btn btn-outline-primary', 'escape' => false]
                        ) ?>

                        <?= $this->Form->postLink(
                            '<i class="fas fa-trash me-2"></i> Delete Appointment',
                            ['action' => 'delete', $appointment->id],
                            ['confirm' => __('Are you sure?'), 'class' => 'btn btn-outline-danger', 'escape' => false]
                        ) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancellation Modal -->
<div class="modal fade" id="cancellationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['action' => isset($currentUser) && $currentUser->role === 'patient' ? 'requestCancellation' : 'cancel', $appointment->id]]) ?>
            <div class="modal-header">
                <h5 class="modal-title">Cancel Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please provide a reason for cancellation:</p>
                <?= $this->Form->control('reason', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3, 'required' => true, 'label' => false]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['action' => 'rejectCancellation', $appointment->id]]) ?>
            <div class="modal-header">
                <h5 class="modal-title">Reject Cancellation Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please provide a reason for rejecting the request:</p>
                <?= $this->Form->control('reason', ['type' => 'textarea', 'class' => 'form-control', 'rows' => 3, 'required' => true, 'label' => false]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Reject Request</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>