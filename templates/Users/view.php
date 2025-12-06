<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-shield"></i>
            User Profile
        </h3>
        <div class="header-actions">
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                <div class="stat-icon" style="width: 64px; height: 64px; font-size: 24px; background: linear-gradient(135deg, #667eea, #764ba2);">
                    <i class="fas fa-user"></i>
                </div>
                <div class="ms-3">
                    <h3 class="mb-1 text-dark"><?= h($user->username) ?></h3>
                    <span class="badge bg-dark text-uppercase"><?= h($user->role) ?></span>
                </div>
                <div class="ms-auto">
                    <span class="status-badge <?= $user->status === 'active' ? 'badge-success' : 'badge-danger' ?>">
                        <?= h(ucfirst($user->status ?? 'Active')) ?>
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="text-uppercase text-muted small fw-bold mb-3">Account Info</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 140px;">User ID:</th>
                            <td>#<?= $this->Number->format($user->id) ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Email:</th>
                            <td><?= h($user->email ?? 'Not Provided') ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Role:</th>
                            <td><?= h(ucfirst($user->role)) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="text-uppercase text-muted small fw-bold mb-3">System Data</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th class="ps-0" style="width: 140px;">Created:</th>
                            <td><?= h($user->created_at ? $user->created_at->format('M d, Y H:i') : '-') ?></td>
                        </tr>
                        <tr>
                            <th class="ps-0">Last Login:</th>
                            <td>-</td> </tr>
                    </table>
                </div>
            </div>
        </div>

        <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
        <div class="card-footer bg-transparent border-top p-3">
            <?= $this->Html->link('<i class="fas fa-edit"></i> Edit', ['action' => 'edit', $user->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            <?= $this->Form->postLink('<i class="fas fa-trash"></i> Delete', ['action' => 'delete', $user->id], ['confirm' => __('Delete user {0}?', $user->username), 'class' => 'btn btn-outline-danger ms-2', 'escape' => false]) ?>
        </div>
        <?php endif; ?>
    </div>
</div>