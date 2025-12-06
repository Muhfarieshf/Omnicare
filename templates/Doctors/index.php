<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Doctor> $doctors
 */
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-md"></i>
            <?= __('Doctors') ?>
        </h3>
        <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
            <?= $this->Html->link(
                '<i class="fas fa-user-plus"></i> New Doctor', 
                ['action' => 'add'], 
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <?php if (empty($doctors)): ?>
            <div class="empty-state">
                <i class="fas fa-user-md"></i>
                <h5>No doctors found</h5>
                <p>
                    <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                        Click "New Doctor" to add the first doctor record.
                    <?php else: ?>
                        No doctor records are available at this time.
                    <?php endif; ?>
                </p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('name', 'Doctor') ?></th>
                            <th><?= $this->Paginator->sort('department_id', 'Department') ?></th>
                            <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th style="text-align: center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?= $this->Number->format($doctor->id) ?></td>
                            <td>
                                <div style="font-weight: 600; color: #2c3e50;">
                                    <?= h($doctor->name) ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($doctor->hasValue('department')): ?>
                                    <?= $this->Html->link(
                                        h($doctor->department->name), 
                                        ['controller' => 'Departments', 'action' => 'view', $doctor->department->id],
                                        ['style' => 'color: var(--primary-color); font-weight: 500; text-decoration: none;']
                                    ) ?>
                                <?php else: ?>
                                    <span class="text-muted">Not Assigned</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                $badgeClass = match($doctor->status) {
                                    'active' => 'badge-success',
                                    'inactive' => 'badge-danger',
                                    default => 'badge-warning'
                                };
                                ?>
                                <span class="status-badge <?= $badgeClass ?>">
                                    <?= h(ucfirst($doctor->status ?? 'Active')) ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $doctor->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']) ?>
                                <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $doctor->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'Edit']) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="fas fa-trash"></i>',
                                        ['action' => 'delete', $doctor->id],
                                        [
                                            'confirm' => __('Are you sure you want to delete # {0}?', $doctor->id),
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
        <?php endif; ?>
    </div>

    <?php if (!empty($doctors)): ?>
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