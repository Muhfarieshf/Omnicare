<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #1f1f1f;
    line-height: 1.6;
    min-height: 100vh;
    padding-top: 56px; /* Account for fixed topbar */
}

/* Background Animation */
body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 102, 204, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
    z-index: -1;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(30px, -30px) rotate(120deg); }
    66% { transform: translate(-20px, 20px) rotate(240deg); }
}

/* Main Container */
.view-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Page Header */
.page-header {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #0066cc, #22c55e, #0066cc);
    background-size: 200% 100%;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
    font-size: 28px;
}

/* Department Info Card */
.info-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 32px;
}

.card-header {
    padding: 24px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(0, 102, 204, 0.02);
}

.card-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f1f1f;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.card-title i {
    color: #0066cc;
    font-size: 18px;
}

.card-body {
    padding: 28px;
}

/* Info Table */
.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table tr {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.info-table tr:last-child {
    border-bottom: none;
}

.info-table th {
    padding: 16px 0;
    font-weight: 600;
    color: #666;
    font-size: 14px;
    text-align: left;
    width: 30%;
    vertical-align: top;
}

.info-table td {
    padding: 16px 0;
    color: #1f1f1f;
    font-size: 14px;
    vertical-align: top;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    gap: 6px;
}

.status-active {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-inactive {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
}

.status-badge i {
    font-size: 8px;
}

/* ID Badge */
.id-badge {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
    padding: 4px 12px;
    border-radius: 16px;
    font-weight: 600;
    font-size: 12px;
    display: inline-block;
    cursor: pointer;
    transition: all 0.2s ease;
}

.id-badge:hover {
    background: rgba(0, 102, 204, 0.2);
    transform: scale(1.05);
}

/* DateTime Values */
.datetime-value {
    font-weight: 500;
    color: #1f1f1f;
}

/* Action Buttons */
.action-buttons {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    padding: 24px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.button-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
    font-family: inherit;
    white-space: nowrap;
}

.btn:hover {
    text-decoration: none;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
    color: white;
}

.btn-secondary {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
    border: 1px solid #6b7280;
}

.btn-secondary:hover {
    background: #6b7280;
    color: white;
    box-shadow: 0 4px 16px rgba(107, 114, 128, 0.3);
}

.btn-danger {
    background: transparent;
    color: #e11d48;
    border: 1px solid #e11d48;
}

.btn-danger:hover {
    background: #e11d48;
    color: white;
    box-shadow: 0 4px 16px rgba(225, 29, 72, 0.3);
}

.btn-outline {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.btn-outline:hover {
    background: #0066cc;
    color: white;
    box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);
}

/* Related Doctors Section */
.related-section {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.section-header {
    padding: 24px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(34, 197, 94, 0.02);
}

.section-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f1f1f;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.section-title i {
    color: #22c55e;
    font-size: 18px;
}

.doctors-count {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
    padding: 4px 12px;
    border-radius: 16px;
    font-size: 12px;
    font-weight: 600;
    margin-left: auto;
}

/* Doctors Table */
.table-container {
    overflow-x: auto;
    padding: 28px;
}

.doctors-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.doctors-table th,
.doctors-table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    font-size: 14px;
}

.doctors-table th {
    font-weight: 600;
    color: #666;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(34, 197, 94, 0.02);
}

.doctors-table tbody tr {
    transition: all 0.2s ease;
}

.doctors-table tbody tr:hover {
    background: rgba(34, 197, 94, 0.02);
}

/* Doctor Actions */
.doctor-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.doctor-actions .btn {
    padding: 6px 12px;
    font-size: 12px;
    min-width: auto;
}

.doctor-actions .btn i {
    font-size: 10px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 48px 24px;
    color: #666;
}

.empty-state i {
    font-size: 56px;
    color: #ccc;
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #1f1f1f;
    margin-bottom: 12px;
    font-size: 18px;
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 768px) {
    .view-container {
        padding: 20px 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        padding: 24px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .card-header,
    .card-body,
    .section-header,
    .table-container {
        padding: 20px;
    }
    
    .info-table th,
    .info-table td {
        padding: 12px 0;
        font-size: 13px;
    }
    
    .info-table th {
        width: 35%;
    }
    
    .button-group {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .doctors-table th,
    .doctors-table td {
        padding: 12px 16px;
        font-size: 13px;
    }
    
    .doctor-actions {
        flex-direction: column;
        gap: 4px;
    }
    
    .doctor-actions .btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .page-header {
        padding: 20px;
    }
    
    .page-title {
        font-size: 20px;
    }
    
    .card-header,
    .card-body,
    .section-header,
    .table-container {
        padding: 16px;
    }
    
    .doctors-table {
        font-size: 12px;
    }
    
    .doctors-table th,
    .doctors-table td {
        padding: 8px 12px;
    }
    
    /* Stack table on very small screens */
    .doctors-table,
    .doctors-table thead,
    .doctors-table tbody,
    .doctors-table th,
    .doctors-table td,
    .doctors-table tr {
        display: block;
    }
    
    .doctors-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
    
    .doctors-table tr {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 12px;
        padding: 12px;
        background: rgba(248, 249, 250, 0.5);
    }
    
    .doctors-table td {
        border: none;
        position: relative;
        padding: 8px 0 8px 35%;
    }
    
    .doctors-table td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 30%;
        padding-right: 10px;
        white-space: nowrap;
        font-weight: 600;
        color: #666;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
}

/* Loading Animation */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn:disabled:hover {
    transform: none !important;
}
</style>

<div class="view-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-building"></i>
            <?= h($department->name) ?>
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back to Departments',
            ['action' => 'index'],
            ['class' => 'btn btn-outline', 'escape' => false]
        ) ?>
    </div>

    <!-- Department Information -->
    <div class="info-card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-info-circle"></i>
                Department Information
            </h5>
        </div>
        <div class="card-body">
            <table class="info-table">
                <tr>
                    <th><i class="fas fa-hashtag"></i> <?= __('ID') ?>:</th>
                    <td>
                        <span class="id-badge" title="Click to copy">#<?= $this->Number->format($department->id) ?></span>
                    </td>
                </tr>
                <tr>
                    <th><i class="fas fa-tag"></i> <?= __('Name') ?>:</th>
                    <td><strong><?= h($department->name) ?></strong></td>
                </tr>
                <tr>
                    <th><i class="fas fa-flag"></i> <?= __('Status') ?>:</th>
                    <td>
                        <span class="status-badge status-<?= h($department->status) === 'active' ? 'active' : 'inactive' ?>">
                            <i class="fas fa-circle"></i>
                            <?= h(ucfirst($department->status)) ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <th><i class="fas fa-plus"></i> <?= __('Created At') ?>:</th>
                    <td>
                        <span class="datetime-value"><?= h($department->created_at->format('M d, Y H:i A')) ?></span>
                    </td>
                </tr>
                <tr>
                    <th><i class="fas fa-edit"></i> <?= __('Updated At') ?>:</th>
                    <td>
                        <span class="datetime-value"><?= h($department->updated_at->format('M d, Y H:i A')) ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
        <div class="action-buttons">
            <div class="button-group">
                <?= $this->Html->link(
                    '<i class="fas fa-edit"></i> ' . __('Edit Department'),
                    ['action' => 'edit', $department->id],
                    ['class' => 'btn btn-primary', 'escape' => false]
                ) ?>
                
                <?= $this->Html->link(
                    '<i class="fas fa-list"></i> ' . __('List Departments'),
                    ['action' => 'index'],
                    ['class' => 'btn btn-secondary', 'escape' => false]
                ) ?>
                
                <?= $this->Form->postLink(
                    '<i class="fas fa-trash"></i> ' . __('Delete Department'),
                    ['action' => 'delete', $department->id],
                    [
                        'confirm' => __('Are you sure you want to delete # {0}?', $department->id),
                        'class' => 'btn btn-danger',
                        'escape' => false
                    ]
                ) ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Related Doctors -->
    <div class="related-section">
        <div class="section-header">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <h4 class="section-title">
                    <i class="fas fa-user-md"></i>
                    <?= __('Related Doctors') ?>
                </h4>
                <?php if (!empty($department->doctors)): ?>
                    <span class="doctors-count">
                        <?= count($department->doctors) ?> <?= count($department->doctors) === 1 ? 'Doctor' : 'Doctors' ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if (!empty($department->doctors)): ?>
            <div class="table-container">
                <table class="doctors-table">
                    <thead>
                        <tr>
                            <th><?= __('ID') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th><?= __('Updated At') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($department->doctors as $doctor): ?>
                            <tr>
                                <td data-label="ID">
                                    <span class="id-badge">#<?= h($doctor->id) ?></span>
                                </td>
                                <td data-label="Name">
                                    <strong><?= h($doctor->name) ?></strong>
                                </td>
                                <td data-label="Status">
                                    <span class="status-badge status-<?= h($doctor->status) === 'active' ? 'active' : 'inactive' ?>">
                                        <i class="fas fa-circle"></i>
                                        <?= h(ucfirst($doctor->status)) ?>
                                    </span>
                                </td>
                                <td data-label="Created">
                                    <span class="datetime-value">
                                        <?= $doctor->created_at ? h($doctor->created_at->format('M d, Y')) : 'N/A' ?>
                                    </span>
                                </td>
                                <td data-label="Updated">
                                    <span class="datetime-value">
                                        <?= $doctor->updated_at ? h($doctor->updated_at->format('M d, Y')) : 'N/A' ?>
                                    </span>
                                </td>
                                <td data-label="Actions">
                                    <div class="doctor-actions">
                                        <?= $this->Html->link(
                                            '<i class="fas fa-eye"></i>',
                                            ['controller' => 'Doctors', 'action' => 'view', $doctor->id],
                                            [
                                                'class' => 'btn btn-outline',
                                                'escape' => false,
                                                'title' => 'View Doctor'
                                            ]
                                        ) ?>
                                        
                                        <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                                            <?= $this->Html->link(
                                                '<i class="fas fa-edit"></i>',
                                                ['controller' => 'Doctors', 'action' => 'edit', $doctor->id],
                                                [
                                                    'class' => 'btn btn-secondary',
                                                    'escape' => false,
                                                    'title' => 'Edit Doctor'
                                                ]
                                            ) ?>
                                            
                                            <?= $this->Form->postLink(
                                                '<i class="fas fa-trash"></i>',
                                                ['controller' => 'Doctors', 'action' => 'delete', $doctor->id],
                                                [
                                                    'method' => 'delete',
                                                    'confirm' => __('Are you sure you want to delete # {0}?', $doctor->id),
                                                    'class' => 'btn btn-danger',
                                                    'escape' => false,
                                                    'title' => 'Delete Doctor'
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
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-user-md"></i>
                <h5>No Doctors Assigned</h5>
                <p>This department doesn't have any doctors assigned yet.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Click to copy ID functionality
    const idBadges = document.querySelectorAll('.id-badge');
    idBadges.forEach(badge => {
        badge.addEventListener('click', function() {
            const idText = this.textContent.replace('#', '');
            navigator.clipboard.writeText(idText).then(() => {
                // Visual feedback
                const originalText = this.textContent;
                const originalBg = this.style.background;
                const originalColor = this.style.color;
                
                this.textContent = 'Copied!';
                this.style.background = 'rgba(34, 197, 94, 0.1)';
                this.style.color = '#22c55e';
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.background = originalBg;
                    this.style.color = originalColor;
                }, 1000);
            });
        });
    });
    
    // Add loading state to action buttons
    const actionButtons = document.querySelectorAll('.btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('#')) {
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                // Restore if navigation is cancelled
                setTimeout(() => {
                    if (this.disabled) {
                        this.innerHTML = originalContent;
                        this.disabled = false;
                    }
                }, 3000);
            }
        });
    });
    
    // Enhanced delete confirmation
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Visual feedback during confirmation
            this.style.background = '#dc2626';
            this.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                this.style.background = '';
                this.style.transform = '';
            }, 200);
        });
    });
    
    // Animate table rows on load
    const tableRows = document.querySelectorAll('.doctors-table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = `all 0.3s ease ${index * 0.1}s`;
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, 100 + (index * 50));
    });
    
    // Print functionality
    const printBtn = document.createElement('button');
    printBtn.className = 'btn btn-outline';
    printBtn.innerHTML = '<i class="fas fa-print"></i> Print Department';
    printBtn.addEventListener('click', () => window.print());
    
    // Add print button to action buttons if they exist
    const actionButtonsContainer = document.querySelector('.button-group');
    if (actionButtonsContainer) {
        actionButtonsContainer.appendChild(printBtn);
    }
});
</script>