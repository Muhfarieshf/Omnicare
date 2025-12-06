<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 */
?>

<div class="view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-md"></i>
            Doctor Profile
        </h3>
        <div class="header-actions">
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                <div class="stat-icon" style="width: 64px; height: 64px; font-size: 24px; background: linear-gradient(135deg, #0066cc, #004499);">
                    <?= strtoupper(substr($doctor->name, 0, 1)) ?>
                </div>
                <div class="ms-3">
                    <h3 class="mb-1 text-primary"><?= h($doctor->name) ?></h3>
                    <p class="mb-0 text-muted">
                        <?= $doctor->hasValue('department') ? h($doctor->department->name) : 'No Department' ?>
                    </p>
                </div>
                <div class="ms-auto">
                    <span class="status-badge <?= strtolower($doctor->status ?? 'active') === 'active' ? 'badge-success' : 'badge-danger' ?>">
                        <?= h($doctor->status ?? 'Active') ?>
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="text-uppercase text-muted small fw-bold mb-3">Details</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 140px;">ID:</th>
                            <td>#<?= $this->Number->format($doctor->id) ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Department:</th>
                            <td>
                                <?= $doctor->hasValue('department') ? 
                                    $this->Html->link($doctor->department->name, ['controller' => 'Departments', 'action' => 'view', $doctor->department->id]) : 
                                    '-' ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0">Email:</th>
                            <td>
                                <?php if (!empty($doctor->email)): ?>
                                    <a href="mailto:<?= h($doctor->email) ?>"><?= h($doctor->email) ?></a>
                                <?php else: ?>
                                    <span class="text-muted">Not Provided</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="text-uppercase text-muted small fw-bold mb-3">System Info</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 140px;">Created:</th>
                            <td><?= h($doctor->created_at ? $doctor->created_at->format('M d, Y g:i A') : 'N/A') ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Last Updated:</th>
                            <td><?= h($doctor->updated_at ? $doctor->updated_at->format('M d, Y g:i A') : 'N/A') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="card-footer bg-transparent border-top p-3">
            <div class="d-flex gap-2">
                <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                    <?= $this->Html->link('<i class="fas fa-edit"></i> Edit', ['action' => 'edit', $doctor->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                    <?php if ($currentUser->role === 'admin'): ?>
                        <?= $this->Form->postLink('<i class="fas fa-trash"></i> Delete', ['action' => 'delete', $doctor->id], ['confirm' => __('Delete {0}?', $doctor->name), 'class' => 'btn btn-outline-danger', 'escape' => false]) ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-calendar-check me-2 text-primary"></i>
                Related Appointments
            </h5>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($doctor->appointments)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($doctor->appointments as $appointment): ?>
                            <tr>
                                <td class="ps-4">#<?= h($appointment->id) ?></td>
                                <td>
                                    <?php if (isset($appointment->patient)): ?>
                                        <?= $this->Html->link($appointment->patient->name, ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id]) ?>
                                    <?php else: ?>
                                        <span class="text-muted">Unknown</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= h($appointment->appointment_date ? $appointment->appointment_date->format('M d, Y') : '-') ?></td>
                                <td class="fw-bold text-primary"><?= h($appointment->appointment_time ? $appointment->appointment_time->format('H:i') : '-') ?></td>
                                <td>
                                    <span class="status-badge badge-<?= strtolower($appointment->status ?? 'scheduled') ?>">
                                        <?= h($appointment->status) ?>
                                    </span>
                                </td>
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
                    <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 48px;"></i>
                    <p class="text-muted">No appointments found for this doctor.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>