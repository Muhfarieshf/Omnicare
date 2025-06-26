<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 */
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Appointment Details</h1>
    <div>
        <?= $this->Html->link('Edit', ['action' => 'edit', $appointment->id], ['class' => 'btn btn-primary me-2']) ?>
        <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Appointment Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">ID:</th>
                        <td><?= $this->Number->format($appointment->id) ?></td>
                    </tr>
                    <tr>
                        <th>Patient:</th>
                        <td>
                            <?= $appointment->has('patient') ? $this->Html->link($appointment->patient->name, ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id]) : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Doctor:</th>
                        <td>
                            <?= $appointment->has('doctor') ? $this->Html->link($appointment->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id]) : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td><?= h($appointment->appointment_date->format('M d, Y')) ?></td>
                    </tr>
                    <tr>
                        <th>Time:</th>
                        <td><?= h($appointment->appointment_time->format('H:i A')) ?></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-<?= $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Cancelled' ? 'danger' : ($appointment->status === 'No Show' ? 'warning' : 'primary')) ?>">
                                <?= h($appointment->status) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Remarks:</th>
                        <td><?= h($appointment->remarks) ?: '<em class="text-muted">No remarks</em>' ?></td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td><?= h($appointment->created_at->format('M d, Y H:i A')) ?></td>
                    </tr>
                    <tr>
                        <th>Updated:</th>
                        <td><?= h($appointment->updated_at->format('M d, Y H:i A')) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <?= $this->Html->link('Edit Appointment', ['action' => 'edit', $appointment->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link('View Patient', ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id], ['class' => 'btn btn-outline-primary']) ?>
                    <?= $this->Html->link('View Doctor', ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id], ['class' => 'btn btn-outline-primary']) ?>
                    <?= $this->Form->postLink('Delete Appointment', ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete this appointment?'), 'class' => 'btn btn-outline-danger']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
