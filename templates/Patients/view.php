<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="patients view content py-4">
                <h3 class="mb-4 text-left"><?= h($patient->name) ?></h3>
                <table class="table table-bordered table-striped mb-4">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($patient->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Gender') ?></th>
                        <td><?= h($patient->gender) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Contact Number') ?></th>
                        <td><?= h($patient->contact_number) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Email') ?></th>
                        <td><?= h($patient->email) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Status') ?></th>
                        <td><?= h($patient->status) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($patient->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Dob') ?></th>
                        <td><?= h($patient->dob) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created At') ?></th>
                        <td><?= h($patient->created_at) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Updated At') ?></th>
                        <td><?= h($patient->updated_at) ?></td>
                    </tr>
                </table>
                <div class="d-flex mb-4">
                    <?php if (isset($currentUser)) : ?>
                        <?php if ($currentUser->role === 'admin' || $currentUser->role === 'receptionist'): ?>
                            <?= $this->Html->link(__('Edit Patient'), ['action' => 'edit', $patient->id], ['class' => 'btn btn-primary me-2']) ?>
                            <?= $this->Form->postLink(__('Delete Patient'), ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id), 'class' => 'btn btn-danger me-2']) ?>
                            <?= $this->Html->link(__('List Patients'), ['action' => 'index'], ['class' => 'btn btn-secondary me-2']) ?>
                            <?= $this->Html->link(__('New Patient'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                        <?php elseif ($currentUser->role === 'patient' && $currentUser->patient_id == $patient->id): ?>
                            <?= $this->Html->link(__('Edit Patient'), ['action' => 'edit', $patient->id], ['class' => 'btn btn-primary']) ?>
                        <?php elseif ($currentUser->role !== 'doctor'): ?>
                            <?= $this->Html->link(__('List Patients'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="related">
                    <h4 class="mb-3 text-left"><?= __('Related Appointments') ?></h4>
                    <?php if (!empty($patient->appointments)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Patient Id') ?></th>
                                    <th><?= __('Doctor Id') ?></th>
                                    <th><?= __('Appointment Date') ?></th>
                                    <th><?= __('Appointment Time') ?></th>
                                    <th><?= __('Status') ?></th>
                                    <th><?= __('Remarks') ?></th>
                                    <th><?= __('Created At') ?></th>
                                    <th><?= __('Updated At') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($patient->appointments as $appointment) : ?>
                                <tr>
                                <td><?= h($appointment->id) ?></td>
                                <td><?= h($appointment->patient_id) ?></td>
                                <td><?= h($appointment->doctor_id) ?></td>
                                <td><?= h($appointment->appointment_date) ?></td>
                                <td><?= h($appointment->appointment_time) ?></td>
                                <td><?= h($appointment->status) ?></td>
                                <td><?= h($appointment->remarks) ?></td>
                                <td><?= h($appointment->created_at) ?></td>
                                <td><?= h($appointment->updated_at) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Appointments', 'action' => 'view', $appointment->id], ['class' => 'btn btn-sm btn-outline-primary me-1', 'escape' => false, 'title' => 'View']) ?>
                                    <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                                        <?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Appointments', 'action' => 'edit', $appointment->id], ['class' => 'btn btn-sm btn-outline-secondary me-1', 'escape' => false, 'title' => 'Edit']) ?>
                                        <?= $this->Form->postLink(
                                            '<i class="fas fa-trash"></i>',
                                            ['controller' => 'Appointments', 'action' => 'delete', $appointment->id],
                                            [
                                                'method' => 'delete',
                                                'confirm' => __('Are you sure you want to delete # {0}?', $appointment->id),
                                                'class' => 'btn btn-sm btn-outline-danger',
                                                'escape' => false,
                                                'title' => 'Delete'
                                            ]
                                        ) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="text-muted">No related appointments found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>