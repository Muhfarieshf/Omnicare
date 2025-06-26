<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doctor'), ['action' => 'edit', $doctor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doctor'), ['action' => 'delete', $doctor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doctor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doctors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doctor'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="doctors view content">
            <h3><?= h($doctor->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($doctor->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $doctor->hasValue('department') ? $this->Html->link($doctor->department->name, ['controller' => 'Departments', 'action' => 'view', $doctor->department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($doctor->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($doctor->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($doctor->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($doctor->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Appointments') ?></h4>
                <?php if (!empty($doctor->appointments)) : ?>
                <div class="table-responsive">
                    <table>
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
                        <?php foreach ($doctor->appointments as $appointment) : ?>
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
                                <?= $this->Html->link(__('View'), ['controller' => 'Appointments', 'action' => 'view', $appointment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Appointments', 'action' => 'edit', $appointment->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Appointments', 'action' => 'delete', $appointment->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $appointment->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>