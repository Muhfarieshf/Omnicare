<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Doctor> $doctors
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.doctors-container {
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

.btn:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
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

.btn-outline-primary {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.btn-outline-primary:hover {
    background: #0066cc;
    color: white;
    transform: translateY(-1px);
}

.btn-outline-secondary {
    background: transparent;
    color: #6b7280;
    border: 1px solid #6b7280;
}

.btn-outline-secondary:hover {
    background: #6b7280;
    color: white;
    transform: translateY(-1px);
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
    padding: 16px 12px;
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
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s ease;
}

.table th a:hover {
    color: #0066cc;
}

.table td {
    color: #1f1f1f;
    font-size: 14px;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: rgba(0, 102, 204, 0.02);
    transform: translateX(2px);
}

/* Doctor Info Styling */
.doctor-name {
    font-weight: 600;
    color: #1f1f1f;
    display: flex;
    align-items: center;
    gap: 8px;
}

.doctor-avatar {
    width: 32px;
    height: 32px;
    border-radius: 16px;
    background: linear-gradient(135deg, #0066cc, #004499);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    font-weight: 600;
}

.department-link {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.department-link:hover {
    color: #0052a3;
    text-decoration: underline;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.active {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-badge.inactive {
    background: rgba(156, 163, 175, 0.1);
    color: #6b7280;
}

/* Date Formatting */
.date-text {
    color: #666;
    font-size: 13px;
}

.time-text {
    color: #666;
    font-size: 12px;
    font-style: italic;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 6px;
    align-items: center;
    justify-content: center;
}

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

.empty-state p {
    color: #666;
    font-size: 14px;
    margin: 0;
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

.pagination li {
    margin: 0;
}

.pagination a,
.pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    font-size: 14px;
    font-weight: 500;
    color: #666;
    text-decoration: none;
    border-radius: 6px;
    transition: all 0.2s ease;
    min-width: 40px;
    height: 40px;
}

.pagination a:hover {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.pagination .current {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    font-weight: 600;
}

.pagination .disabled {
    color: #ccc;
    cursor: not-allowed;
}

.pagination-info {
    color: #666;
    font-size: 14px;
}

/* Stats Summary (optional enhancement) */
.stats-summary {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 20px 24px;
    margin-bottom: 24px;
    display: flex;
    gap: 32px;
    align-items: center;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stat-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
}

.stat-icon.doctors {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.stat-icon.departments {
    background: linear-gradient(135deg, #0066cc, #004499);
}

.stat-content h4 {
    font-size: 18px;
    font-weight: 700;
    color: #1f1f1f;
    margin: 0 0 2px 0;
}

.stat-content p {
    font-size: 12px;
    color: #666;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .table th:nth-child(5),
    .table td:nth-child(5),
    .table th:nth-child(6),
    .table td:nth-child(6) {
        display: none; /* Hide created/updated columns on medium screens */
    }
}

@media (max-width: 768px) {
    .doctors-container {
        padding: 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .stats-summary {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .table th:nth-child(1),
    .table td:nth-child(1) {
        display: none; /* Hide ID column on mobile */
    }
    
    .table th,
    .table td {
        padding: 12px 8px;
        font-size: 12px;
    }
    
    .doctor-name {
        flex-direction: column;
        gap: 4px;
        text-align: center;
    }
    
    .doctor-avatar {
        width: 24px;
        height: 24px;
        font-size: 10px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .pagination-container {
        flex-direction: column;
        text-align: center;
    }
    
    .pagination {
        justify-content: center;
        flex-wrap: wrap;
    }
}

@media (max-width: 480px) {
    .table th:nth-child(4),
    .table td:nth-child(4) {
        display: none; /* Hide status column on very small screens */
    }
    
    .table th,
    .table td {
        padding: 8px 6px;
        font-size: 11px;
    }
    
    .btn-sm {
        padding: 4px 8px;
        font-size: 10px;
    }
}
</style>

<div class="doctors-container">
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

    <!-- Optional Stats Summary -->
    <?php if (isset($totalDoctors) || isset($totalDepartments)): ?>
    <div class="stats-summary">
        <?php if (isset($totalDoctors)): ?>
        <div class="stat-item">
            <div class="stat-icon doctors">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="stat-content">
                <h4><?= $totalDoctors ?></h4>
                <p>Total Doctors</p>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (isset($totalDepartments)): ?>
        <div class="stat-item">
            <div class="stat-icon departments">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-content">
                <h4><?= $totalDepartments ?></h4>
                <p>Departments</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

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
                            <th><?= $this->Paginator->sort('created_at', 'Created') ?></th>
                            <th><?= $this->Paginator->sort('updated_at', 'Updated') ?></th>
                            <th style="text-align: center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td><?= $this->Number->format($doctor->id) ?></td>
                            <td>
                                <div class="doctor-name">
                                    <div class="doctor-avatar">
                                        <?= strtoupper(substr($doctor->name, 0, 1)) ?>
                                    </div>
                                    <span><?= h($doctor->name) ?></span>
                                </div>
                            </td>
                            <td>
                                <?php if ($doctor->hasValue('department')): ?>
                                    <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'view', $doctor->department->id]) ?>" class="department-link">
                                        <?= h($doctor->department->name) ?>
                                    </a>
                                <?php else: ?>
                                    <span style="color: #ccc;">Not Assigned</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge <?= strtolower($doctor->status ?? 'active') ?>">
                                    <?= h($doctor->status ?? 'Active') ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($doctor->created_at): ?>
                                    <div class="date-text"><?= h($doctor->created_at->format('M d, Y')) ?></div>
                                    <div class="time-text"><?= h($doctor->created_at->format('g:i A')) ?></div>
                                <?php else: ?>
                                    <span style="color: #ccc;">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($doctor->updated_at): ?>
                                    <div class="date-text"><?= h($doctor->updated_at->format('M d, Y')) ?></div>
                                    <div class="time-text"><?= h($doctor->updated_at->format('g:i A')) ?></div>
                                <?php else: ?>
                                    <span style="color: #ccc;">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $doctor->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                    <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                                        <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $doctor->id], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false]) ?>
                                        <?= $this->Form->postLink(
                                            '<i class="fas fa-trash"></i>',
                                            ['action' => 'delete', $doctor->id],
                                            [
                                                'method' => 'delete',
                                                'confirm' => __('Are you sure you want to delete # {0}?', $doctor->id),
                                                'class' => 'btn btn-sm btn-outline-danger',
                                                'escape' => false
                                            ]
                                        ) ?>
                                    <?php endif; ?>
                                </div>
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
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
    <?php endif; ?>
</div>