<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\WaitingList> $waitingList
 * @var \App\Model\Entity\User $user
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.list-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0 32px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: inherit;
}

.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    color: white;
}

.btn-outline-danger {
    background: transparent;
    color: #e11d48;
    border: 1px solid #e11d48;
}

.btn-outline-danger:hover {
    background: #e11d48;
    color: white;
    transform: translateY(-1px);
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
}

/* Table Container */
.table-container {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 24px;
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.table th,
.table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.table th {
    font-weight: 600;
    color: #666;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(248, 249, 250, 0.8);
    position: sticky;
    top: 0;
    z-index: 10;
}

.table th a {
    color: #666;
    text-decoration: none;
}

.table td {
    color: #1f1f1f;
    font-size: 14px;
}

.table tbody tr:hover {
    background: rgba(0, 102, 204, 0.02);
}

/* Links */
.table td a {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
}

.table td a:hover {
    text-decoration: underline;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.status-badge.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-badge i {
    font-size: 10px;
    margin-right: 4px;
}

/* Priority Badges */
.priority-badge {
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}
.priority-high { background: rgba(225, 29, 72, 0.1); color: #e11d48; }
.priority-normal { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.priority-low { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-state i {
    font-size: 64px;
    margin-bottom: 20px;
    color: #ccc;
}

.empty-state h5 {
    color: #1f1f1f;
    margin-bottom: 12px;
    font-weight: 600;
}

/* Pagination */
.pagination-container {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.pagination {
    display: flex;
    list-style: none;
    gap: 4px;
    margin: 0;
    padding: 0;
}

.pagination a, .pagination span {
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    color: #666;
    font-size: 14px;
    font-weight: 500;
}

.pagination a:hover {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.pagination .current {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
}
</style>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-hourglass-half"></i>
            Waiting List
        </h3>
        <?php if ($user->role === 'patient'): ?>
            <?= $this->Html->link(
                '<i class="fas fa-plus"></i> Join Waiting List', 
                ['action' => 'add'], 
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <?php if ($waitingList->count() === 0): ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h5>No requests found</h5>
                <p>The waiting list is currently empty.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('priority') ?></th>
                            <th><?= $this->Paginator->sort('patient_id', 'Patient') ?></th>
                            <th>Preference</th>
                            <th><?= $this->Paginator->sort('preferred_date', 'Preferred Date') ?></th>
                            <th><?= $this->Paginator->sort('status') ?></th>
                            <th><?= $this->Paginator->sort('created_at', 'Requested') ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($waitingList as $item): ?>
                <tr>
                    <td>
                        <?php if($item->priority <= 3): ?>
                            <span class="priority-badge priority-high">High</span>
                        <?php elseif($item->priority >= 8): ?>
                            <span class="priority-badge priority-low">Low</span>
                        <?php else: ?>
                            <span class="priority-badge priority-normal">Normal</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= !empty($item->patient) ? $this->Html->link($item->patient->name, ['controller' => 'Patients', 'action' => 'view', $item->patient->id]) : '<span class="text-muted">Unknown</span>' ?>
                    </td>
                    <td>
                        <?php if (!empty($item->doctor)): ?>
                            <div style="display:flex; align-items:center; gap:6px;">
                                <i class="fas fa-user-md" style="color:#666;"></i> Dr. <?= h($item->doctor->name) ?>
                            </div>
                        <?php elseif (!empty($item->department)): ?>
                            <div style="display:flex; align-items:center; gap:6px;">
                                <i class="fas fa-building" style="color:#666;"></i> <?= h($item->department->name) ?>
                            </div>
                        <?php else: ?>
                            <span style="color: #999;">Any Available</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($item->preferred_date): ?>
                            <div style="font-weight:500;"><?= h($item->preferred_date->format('M d, Y')) ?></div>
                            <?php if ($item->preferred_time): ?>
                                <div style="font-size:12px; color:#666;">
                                    Around <?= h($item->preferred_time->format('h:i A')) ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <span style="color: #666;">ASAP</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        $statusClass = 'warning'; // Default pending
                        $statusIcon = 'fa-clock';
                        if ($item->status === 'notified') {
                            $statusClass = 'success';
                            $statusIcon = 'fa-bell';
                        }
                        ?>
                        <span class="status-badge <?= $statusClass ?>">
                            <i class="fas <?= $statusIcon ?>"></i>
                            <?= ucfirst(h($item->status)) ?>
                        </span>
                    </td>
                    <td>
                        <span title="<?= $item->created_at->format('Y-m-d H:i') ?>">
                            <?= h($item->created_at->timeAgoInWords()) ?>
                        </span>
                    </td>
                    <td>
                        <?= $this->Form->postLink(
                            '<i class="fas fa-times"></i> Remove',
                            ['action' => 'delete', $item->id],
                            [
                                'confirm' => __('Are you sure you want to remove this request?'),
                                'class' => 'btn btn-sm btn-outline-danger',
                                'escape' => false
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($waitingList->count() > 0): ?>
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