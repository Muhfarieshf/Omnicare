<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-calendar-check"></i>
            <?= __('Appointments') ?>
        </h3>
        <div class="d-flex gap-2">
            <?= $this->Html->link(
                '<i class="fas fa-calendar-day"></i> Dashboard', 
                ['action' => 'dashboard'], 
                ['class' => 'btn btn-outline-primary', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fas fa-plus"></i> New Appointment', 
                ['action' => 'add'], 
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body py-3">
            <?= $this->Form->create(null, ['type' => 'get', 'class' => 'row g-3 align-items-end']) ?>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Status</label>
                    <?= $this->Form->select('status', [
                        '' => 'All Statuses',
                        'Scheduled' => 'Scheduled',
                        'Confirmed' => 'Confirmed',
                        'In Progress' => 'In Progress',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                        'No Show' => 'No Show',
                        'Pending Approval' => 'Pending Approval'
                    ], [
                        'value' => $this->request->getQuery('status'),
                        'class' => 'form-select form-select-sm'
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Date From</label>
                    <?= $this->Form->date('date_from', [
                        'value' => $this->request->getQuery('date_from'),
                        'class' => 'form-control form-control-sm'
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-muted">Date To</label>
                    <?= $this->Form->date('date_to', [
                        'value' => $this->request->getQuery('date_to'),
                        'class' => 'form-control form-control-sm'
                    ]) ?>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-sm w-100 mb-1">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-outline-secondary btn-sm w-100']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="table-container">
        <?php if ($appointments->count() === 0): ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h5>No appointments found</h5>
                <p>Click "New Appointment" to schedule the first appointment.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('patient_id', 'Patient') ?></th>
                            <th><?= $this->Paginator->sort('doctor_id', 'Doctor') ?></th>
                            <th><?= $this->Paginator->sort('appointment_date', 'Date') ?></th>
                            <th><?= $this->Paginator->sort('appointment_time', 'Time') ?></th>
                            <th>Duration</th>
                            <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= $this->Number->format($appointment->id) ?></td>
                            <td>
                                <?= $appointment->has('patient') ? $this->Html->link($appointment->patient->name, ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id], ['class' => 'text-decoration-none fw-bold text-dark']) : '-' ?>
                            </td>
                            <td>
                                <?= $appointment->has('doctor') ? $this->Html->link($appointment->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id], ['class' => 'text-decoration-none text-primary']) : '-' ?>
                            </td>
                            <td><?= h($appointment->appointment_date->format('M d, Y')) ?></td>
                            <td class="fw-bold text-primary"><?= h($appointment->appointment_time->format('H:i')) ?></td>
                            <td><?= h($appointment->duration_minutes ?? 30) ?> min</td>
                            <td>
                                <?php
                                $badgeClass = 'badge-secondary';
                                $icon = 'fa-circle';
                                
                                switch($appointment->status) {
                                    case 'Confirmed': $badgeClass = 'badge-info'; $icon='fa-check-circle'; break;
                                    case 'In Progress': $badgeClass = 'badge-warning'; $icon='fa-spinner'; break;
                                    case 'Completed': $badgeClass = 'badge-success'; $icon='fa-check-circle'; break;
                                    case 'Cancelled': $badgeClass = 'badge-danger'; $icon='fa-times-circle'; break;
                                    case 'No Show': $badgeClass = 'badge-warning'; $icon='fa-exclamation-triangle'; break;
                                    case 'Pending Approval': $badgeClass = 'badge-warning'; $icon='fa-clock'; break;
                                    default: $badgeClass = 'badge-scheduled'; $icon='fa-calendar-check';
                                }
                                ?>
                                <span class="status-badge <?= $badgeClass ?>">
                                    <i class="fas <?= $icon ?>"></i> <?= h($appointment->status) ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="d-inline-flex gap-1">
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $appointment->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']) ?>
                                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $appointment->id], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false, 'title' => 'Edit']) ?>
                                    
                                    <?php if ($appointment->status === 'Confirmed'): ?>
                                        <?= $this->Form->postLink('<i class="fas fa-play"></i>', ['action' => 'start', $appointment->id], ['class' => 'btn btn-sm btn-outline-success', 'escape' => false, 'title' => 'Start', 'confirm' => __('Start this appointment?')]) ?>
                                    <?php endif; ?>
                                    
                                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete this appointment?'), 'class' => 'btn btn-sm btn-outline-danger', 'escape' => false, 'title' => 'Delete']) ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($appointments->count() > 0): ?>
    <div class="pagination-container">
        <div class="pagination-info">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
    <?php endif; ?>
</div>