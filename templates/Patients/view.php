<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>

<div class="view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user"></i>
            Patient Profile
        </h3>
        <div class="header-actions">
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                <div class="stat-icon" style="width: 64px; height: 64px; font-size: 24px; background: linear-gradient(135deg, #22c55e, #16a34a);">
                    <?= strtoupper(substr($patient->name, 0, 1)) ?>
                </div>
                <div class="ms-3">
                    <h3 class="mb-1 text-success"><?= h($patient->name) ?></h3>
                    <p class="mb-0 text-muted">
                        <?php if ($patient->dob): ?>
                            <?= $patient->dob->diff(\Cake\I18n\FrozenDate::now())->y ?> Years Old
                        <?php else: ?>
                            Age Unknown
                        <?php endif; ?>
                    </p>
                </div>
                <div class="ms-auto">
                    <span class="status-badge <?= strtolower($patient->status ?? 'active') === 'active' ? 'badge-success' : 'badge-danger' ?>">
                        <?= h($patient->status ?? 'Active') ?>
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="text-uppercase text-muted small fw-bold mb-3">Personal Details</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 140px;">Gender:</th>
                            <td><?= h($patient->gender ?? 'Not Specified') ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Date of Birth:</th>
                            <td><?= h($patient->dob ? $patient->dob->format('M d, Y') : '-') ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Phone:</th>
                            <td><?= h($patient->contact_number ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Email:</th>
                            <td>
                                <?php if ($patient->email): ?>
                                    <a href="mailto:<?= h($patient->email) ?>"><?= h($patient->email) ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="text-uppercase text-muted small fw-bold mb-3">System Info</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 140px;">Patient ID:</th>
                            <td>#<?= $this->Number->format($patient->id) ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Created:</th>
                            <td><?= h($patient->created_at ? $patient->created_at->format('M d, Y') : 'N/A') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card-footer bg-transparent border-top p-3">
            <div class="d-flex gap-2">
                <?php if (isset($currentUser) && ($currentUser->role === 'admin' || $currentUser->role === 'receptionist' || $currentUser->id === $patient->user_id)): ?>
                    <?= $this->Html->link('<i class="fas fa-edit"></i> Edit', ['action' => 'edit', $patient->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                <?php endif; ?>
                <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
                    <?= $this->Form->postLink('<i class="fas fa-trash"></i> Delete', ['action' => 'delete', $patient->id], ['confirm' => __('Delete {0}?', $patient->name), 'class' => 'btn btn-outline-danger', 'escape' => false]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-history me-2 text-primary"></i>
                Appointment History
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($patient->appointments)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Date</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patient->appointments as $appointment): ?>
                            <tr>
                                <td class="ps-4 fw-bold text-primary">
                                    <?= h($appointment->appointment_date ? $appointment->appointment_date->format('M d, Y') : '-') ?>
                                    <br>
                                    <small class="text-muted fw-normal"><?= h($appointment->appointment_time ? $appointment->appointment_time->format('H:i') : '') ?></small>
                                </td>
                                <td>
                                    <?php if (isset($appointment->doctor)): ?>
                                        Dr. <?= h($appointment->doctor->name) ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="status-badge badge-<?= strtolower($appointment->status ?? 'scheduled') ?>">
                                        <?= h($appointment->status) ?>
                                    </span>
                                </td>
                                <td><?= h($appointment->remarks ?: '-') ?></td>
                                <td>
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Appointments', 'action' => 'view', $appointment->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center p-5">
                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 48px;"></i>
                    <p class="text-muted">No appointment history available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>