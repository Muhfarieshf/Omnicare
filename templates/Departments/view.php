<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>

<div class="view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-building"></i>
            <?= h($department->name) ?>
        </h3>
        <div class="header-actions">
            <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div class="stat-icon" style="width: 56px; height: 56px; font-size: 24px; background: #eef2ff; color: var(--primary-color);">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="ms-3">
                    <h4 class="mb-1"><?= h($department->name) ?></h4>
                    <span class="status-badge <?= $department->status === 'active' ? 'badge-success' : 'badge-danger' ?>">
                        <?= h(ucfirst($department->status)) ?>
                    </span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Created:</strong> <?= h($department->created_at->format('M d, Y')) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Last Updated:</strong> <?= h($department->updated_at->format('M d, Y')) ?></p>
                </div>
            </div>
        </div>
        
        <?php if (isset($currentUser) && $currentUser->role === 'admin'): ?>
        <div class="card-footer bg-transparent border-top p-3">
            <?= $this->Html->link('<i class="fas fa-edit"></i> Edit', ['action' => 'edit', $department->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            <?= $this->Form->postLink('<i class="fas fa-trash"></i> Delete', ['action' => 'delete', $department->id], ['confirm' => __('Delete {0}?', $department->name), 'class' => 'btn btn-outline-danger ms-2', 'escape' => false]) ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-user-md me-2 text-primary"></i> Assigned Doctors</h5>
            <span class="badge bg-secondary"><?= count($department->doctors) ?></span>
        </div>
        <div class="card-body p-0">
            <?php if (!empty($department->doctors)): ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($department->doctors as $doctor): ?>
                            <tr>
                                <td class="ps-4 fw-bold">Dr. <?= h($doctor->name) ?></td>
                                <td>
                                    <span class="status-badge <?= $doctor->status === 'active' ? 'badge-success' : 'badge-warning' ?>">
                                        <?= h($doctor->status) ?>
                                    </span>
                                </td>
                                <td><?= h($doctor->created_at->format('M Y')) ?></td>
                                <td>
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Doctors', 'action' => 'view', $doctor->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center p-5">
                    <i class="fas fa-user-slash text-muted mb-3" style="font-size: 48px;"></i>
                    <p class="text-muted">No doctors assigned to this department yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>