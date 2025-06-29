<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $appointments
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.appointments-container {
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

/* Patient and Doctor Links */
.table td a {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
}

.table td a:hover {
    color: #0052a3;
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

.status-badge.primary {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.status-badge.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-badge.danger {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.status-badge.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
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

/* Filter Bar (if you want to add filters later) */
.filter-bar {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 20px 24px;
    margin-bottom: 24px;
    display: none; /* Hidden by default, can be shown when needed */
}

/* Responsive Design */
@media (max-width: 768px) {
    .appointments-container {
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
    
    .table th,
    .table td {
        padding: 12px 8px;
        font-size: 12px;
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
    .table th:nth-child(1),
    .table td:nth-child(1) {
        display: none; /* Hide ID column on very small screens */
    }
    
    .table th,
    .table td {
        padding: 8px 6px;
        font-size: 11px;
    }
    
    .action-buttons {
        gap: 2px;
    }
    
    .btn-sm {
        padding: 4px 8px;
        font-size: 10px;
    }
}
</style>

<div class="appointments-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-calendar-check"></i>
            Appointments
        </h3>
        <?= $this->Html->link(
            '<i class="fas fa-plus"></i> New Appointment', 
            ['action' => 'add'], 
            ['class' => 'btn btn-success', 'escape' => false]
        ) ?>
    </div>

    <div class="table-container">
        <?php if (empty($appointments)): ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h5>No appointments found</h5>
                <p>Click "New Appointment" to schedule the first appointment.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('patient_id', 'Patient') ?></th>
                            <th><?= $this->Paginator->sort('doctor_id', 'Doctor') ?></th>
                            <th><?= $this->Paginator->sort('appointment_date', 'Date') ?></th>
                            <th><?= $this->Paginator->sort('appointment_time', 'Time') ?></th>
                            <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?= $this->Number->format($appointment->id) ?></td>
                            <td>
                                <?= $appointment->has('patient') ? $this->Html->link($appointment->patient->name, ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id]) : '' ?>
                            </td>
                            <td>
                                <?= $appointment->has('doctor') ? $this->Html->link($appointment->doctor->name, ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id]) : '' ?>
                            </td>
                            <td><?= h($appointment->appointment_date->format('M d, Y')) ?></td>
                            <td><?= h($appointment->appointment_time->format('H:i')) ?></td>
                            <td>
                                <span class="status-badge <?= $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Cancelled' ? 'danger' : ($appointment->status === 'No Show' ? 'warning' : 'primary')) ?>">
                                    <?= h($appointment->status) ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $appointment->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $appointment->id], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false]) ?>
                                    <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $appointment->id], ['confirm' => __('Are you sure you want to delete this appointment?'), 'class' => 'btn btn-sm btn-outline-danger', 'escape' => false]) ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($appointments)): ?>
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