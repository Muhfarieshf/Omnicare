<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\DoctorSchedule> $doctorSchedules
 * @var array $days
 * @var \App\Model\Entity\User $user
 */
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-clock"></i>
            <?= __('Schedule Management') ?>
        </h3>
        <?= $this->Html->link(
            '<i class="fas fa-plus"></i> Add New Slot',
            ['action' => 'add'],
            ['class' => 'btn btn-success', 'escape' => false]
        ) ?>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <?php if ($user->role === 'admin'): ?>
                            <th><?= $this->Paginator->sort('doctor_id', 'Doctor') ?></th>
                        <?php endif; ?>
                        <th><?= $this->Paginator->sort('day_of_week', 'Day') ?></th>
                        <th><?= $this->Paginator->sort('start_time', 'Start Time') ?></th>
                        <th><?= $this->Paginator->sort('end_time', 'End Time') ?></th>
                        <th><?= $this->Paginator->sort('is_available', 'Status') ?></th>
                        <th style="text-align: center;"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctorSchedules as $schedule): ?>
                    <tr>
                        <?php if ($user->role === 'admin'): ?>
                            <td style="font-weight: 600;">
                                <i class="fas fa-user-md me-2 text-muted"></i>
                                <?= $schedule->has('doctor') ? h($schedule->doctor->name) : '' ?>
                            </td>
                        <?php endif; ?>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <?= $days[$schedule->day_of_week] ?>
                            </span>
                        </td>
                        <td class="time-cell">
                            <?= h($schedule->start_time->format('h:i A')) ?>
                        </td>
                        <td class="time-cell">
                            <?= h($schedule->end_time->format('h:i A')) ?>
                        </td>
                        <td>
                            <?php if ($schedule->is_available): ?>
                                <span class="status-badge badge-success"><i class="fas fa-check"></i> Available</span>
                            <?php else: ?>
                                <span class="status-badge badge-danger"><i class="fas fa-times"></i> Unavailable</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $schedule->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'Edit']) ?>
                            <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $schedule->id], ['confirm' => __('Are you sure you want to delete this schedule?'), 'class' => 'btn btn-sm btn-outline-danger', 'escape' => false, 'title' => 'Delete']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($doctorSchedules)): ?>
    <div class="pagination-container">
        <div class="pagination-info">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}')) ?>
        </div>
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('prev')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
    </div>
    <?php endif; ?>
</div>