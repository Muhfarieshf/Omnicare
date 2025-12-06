<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-users-cog"></i>
            <?= __('System Users') ?>
        </h3>
        <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
            <?= $this->Html->link(
                '<i class="fas fa-user-plus"></i> New User', 
                ['action' => 'add'], 
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <?php if (empty($users)): ?>
            <div class="empty-state">
                <i class="fas fa-user-shield"></i>
                <h5>No users found</h5>
                <p>No user records are available.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('username', 'Username') ?></th>
                            <th><?= $this->Paginator->sort('role', 'Role') ?></th>
                            <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th style="text-align: center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td style="font-weight: 600;">
                                <?= h($user->username) ?>
                            </td>
                            <td>
                                <?php 
                                $roleBadge = match($user->role) {
                                    'admin' => 'badge-danger',
                                    'doctor' => 'badge-info',
                                    'patient' => 'badge-success',
                                    default => 'badge-warning'
                                };
                                ?>
                                <span class="status-badge <?= $roleBadge ?>">
                                    <?= h(ucfirst($user->role)) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge <?= $user->status === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                    <?= h(ucfirst($user->status ?? 'Active')) ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="fas fa-trash"></i>',
                                        ['action' => 'delete', $user->id],
                                        [
                                            'confirm' => __('Delete user {0}?', $user->username),
                                            'class' => 'btn btn-sm btn-outline-danger',
                                            'escape' => false
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

    <?php if (!empty($users)): ?>
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