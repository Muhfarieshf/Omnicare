<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Appointments</h1>
    <?= $this->Html->link('New Appointment', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($appointments)): ?>
            <div class="text-center py-4">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No appointments found</h5>
                <p class="text-muted">Click "New Appointment" to schedule the first appointment.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('patient_id', 'Patient') ?></th>
                            <th><?= $this->Paginator->sort('doctor_id', 'Doctor') ?></th>
                            <th><?= $this->Paginator->sort('appointment_date', 'Date') ?></th>
                            <th><?= $this->Paginator->sort('appointment_time', 'Time') ?></th>
                            <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= $this->Number->format($appointment->id) ?></td>
                            <td>
                                <?= $appointment->has('patient') ? $this->Html->link($appointment->patient->name, ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id]) : '' ?>
                            </td>
                            <td>
                                <?= $appointment->has('doctor') ? $this->Html->link($appointment->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id]) : '' ?>
                            </td>
                            <td><?= h($appointment->appointment_date->format('M d, Y')) ?></td>
                            <td><?= h($appointment->appointment_time->format('H:i')) ?></td>
                            <td>
                                <span class="badge bg-<?= $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Cancelled' ? 'danger' : ($appointment->status === 'No Show' ? 'warning' : 'primary')) ?>">
                                    <?= h($appointment->status) ?>
                                </span>
                            </td>
                            <td class="actions">
                                <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $appointment->id], ['class' => 'btn btn-sm btn-outline-primary me-1', 'escape' => false, 'title' => 'View']) ?>
                                <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $appointment->id], ['class' => 'btn btn-sm btn-outline-secondary me-1', 'escape' => false, 'title' => 'Edit']) ?>
                                <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete this appointment?'), 'class' => 'btn btn-sm btn-outline-danger', 'escape' => false, 'title' => 'Delete']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="paginator">
                <ul class="pagination justify-content-center">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p class="text-center text-muted">
                    <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>