<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
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

.header-actions {
    display: flex;
    gap: 12px;
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 32px;
}

/* Cards */
.info-card,
.actions-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.info-card:hover,
.actions-card:hover {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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

/* Status Badges */
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

.status-completed {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-cancelled {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.status-no-show {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.status-scheduled {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

/* Links in table */
.patient-link,
.doctor-link {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.patient-link:hover,
.doctor-link:hover {
    color: #004499;
    text-decoration: none;
}

.patient-link i,
.doctor-link i {
    font-size: 12px;
}

/* Buttons */
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
    width: 100%;
    margin-bottom: 12px;
}

.btn:hover {
    text-decoration: none;
    transform: translateY(-1px);
}

.btn:last-child {
    margin-bottom: 0;
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

/* Header buttons (smaller) */
.header-actions .btn {
    padding: 10px 20px;
    font-size: 13px;
    margin-bottom: 0;
    width: auto;
}

/* Remarks styling */
.remarks-content {
    background: rgba(248, 249, 250, 0.5);
    padding: 12px 16px;
    border-radius: 8px;
    border-left: 4px solid #0066cc;
    margin-top: 4px;
}

.no-remarks {
    color: #666;
    font-style: italic;
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
}

/* DateTime styling */
.datetime-value {
    font-weight: 500;
    color: #1f1f1f;
}

.date-value {
    color: #0066cc;
    font-weight: 600;
}

.time-value {
    color: #22c55e;
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}

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
    
    .header-actions {
        align-self: stretch;
    }
    
    .header-actions .btn {
        flex: 1;
    }
    
    .card-header,
    .card-body {
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
}

@media (max-width: 480px) {
    .page-header {
        padding: 20px;
    }
    
    .page-title {
        font-size: 20px;
    }
    
    .card-header,
    .card-body {
        padding: 16px;
    }
    
    .btn {
        padding: 10px 16px;
        font-size: 13px;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 8px;
    }
}

/* Print Styles */
@media print {
    body::before {
        display: none;
    }
    
    .page-header,
    .info-card,
    .actions-card {
        background: white !important;
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
    
    .actions-card {
        display: none;
    }
}
</style>

<div class="view-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-calendar-alt"></i>
            Appointment Details
        </h1>
        <div class="header-actions">
            <?= $this->Html->link(
                '<i class="fas fa-edit"></i> Edit',
                ['action' => 'edit', $appointment->id],
                ['class' => 'btn btn-primary', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fas fa-arrow-left"></i> Back to List',
                ['action' => 'index'],
                ['class' => 'btn btn-secondary', 'escape' => false]
            ) ?>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Appointment Information -->
        <div class="info-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Appointment Information
                </h5>
            </div>
            <div class="card-body">
                <table class="info-table">
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID:</th>
                        <td>
                            <span class="id-badge">#<?= $this->Number->format($appointment->id) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-user"></i> Patient:</th>
                        <td>
                            <?= $appointment->has('patient') ? $this->Html->link(
                                '<i class="fas fa-external-link-alt"></i> ' . $appointment->patient->name,
                                ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id],
                                ['class' => 'patient-link', 'escape' => false]
                            ) : 'N/A' ?>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-user-md"></i> Doctor:</th>
                        <td>
                            <?= $appointment->has('doctor') ? $this->Html->link(
                                '<i class="fas fa-external-link-alt"></i> Dr. ' . $appointment->doctor->name,
                                ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id],
                                ['class' => 'doctor-link', 'escape' => false]
                            ) : 'N/A' ?>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-calendar"></i> Date:</th>
                        <td>
                            <span class="date-value"><?= h($appointment->appointment_date->format('M d, Y')) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-clock"></i> Time:</th>
                        <td>
                            <span class="time-value"><?= h($appointment->appointment_time->format('H:i A')) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-flag"></i> Status:</th>
                        <td>
                            <?php
                            $statusClass = 'status-scheduled';
                            $statusIcon = 'fas fa-calendar';
                            
                            switch ($appointment->status) {
                                case 'Completed':
                                    $statusClass = 'status-completed';
                                    $statusIcon = 'fas fa-check-circle';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'status-cancelled';
                                    $statusIcon = 'fas fa-times-circle';
                                    break;
                                case 'No Show':
                                    $statusClass = 'status-no-show';
                                    $statusIcon = 'fas fa-exclamation-triangle';
                                    break;
                                default:
                                    $statusClass = 'status-scheduled';
                                    $statusIcon = 'fas fa-calendar-check';
                            }
                            ?>
                            <span class="status-badge <?= $statusClass ?>">
                                <i class="<?= $statusIcon ?>"></i>
                                <?= h($appointment->status) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-sticky-note"></i> Remarks:</th>
                        <td>
                            <?php if (!empty($appointment->remarks)): ?>
                                <div class="remarks-content">
                                    <?= h($appointment->remarks) ?>
                                </div>
                            <?php else: ?>
                                <span class="no-remarks">No remarks</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-plus"></i> Created:</th>
                        <td>
                            <span class="datetime-value"><?= h($appointment->created_at->format('M d, Y H:i A')) ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-edit"></i> Updated:</th>
                        <td>
                            <span class="datetime-value"><?= h($appointment->updated_at->format('M d, Y H:i A')) ?></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="actions-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-bolt"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <?= $this->Html->link(
                    '<i class="fas fa-edit"></i> Edit Appointment',
                    ['action' => 'edit', $appointment->id],
                    ['class' => 'btn btn-primary', 'escape' => false]
                ) ?>
                
                <?php if ($appointment->has('patient')): ?>
                <?= $this->Html->link(
                    '<i class="fas fa-user"></i> View Patient',
                    ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id],
                    ['class' => 'btn btn-outline', 'escape' => false]
                ) ?>
                <?php endif; ?>
                
                <?php if ($appointment->has('doctor')): ?>
                <?= $this->Html->link(
                    '<i class="fas fa-user-md"></i> View Doctor',
                    ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id],
                    ['class' => 'btn btn-outline', 'escape' => false]
                ) ?>
                <?php endif; ?>
                
                <?= $this->Html->link(
                    '<i class="fas fa-list"></i> All Appointments',
                    ['action' => 'index'],
                    ['class' => 'btn btn-outline', 'escape' => false]
                ) ?>
                
                <?= $this->Form->postLink(
                    '<i class="fas fa-trash"></i> Delete Appointment',
                    ['action' => 'delete', $appointment->id],
                    [
                        'confirm' => __('Are you sure you want to delete this appointment?'),
                        'class' => 'btn btn-danger',
                        'escape' => false
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add confirmation for delete with better styling
    const deleteBtn = document.querySelector('.btn-danger');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function(e) {
            // Additional visual feedback
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
        });
    }
    
    // Add copy ID functionality
    const idBadge = document.querySelector('.id-badge');
    if (idBadge) {
        idBadge.style.cursor = 'pointer';
        idBadge.title = 'Click to copy ID';
        
        idBadge.addEventListener('click', function() {
            const idText = this.textContent.replace('#', '');
            navigator.clipboard.writeText(idText).then(() => {
                // Visual feedback
                const originalText = this.textContent;
                this.textContent = 'Copied!';
                this.style.background = 'rgba(34, 197, 94, 0.1)';
                this.style.color = '#22c55e';
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.background = 'rgba(0, 102, 204, 0.1)';
                    this.style.color = '#0066cc';
                }, 1000);
            });
        });
    }
    
    // Print functionality
    const printBtn = document.createElement('button');
    printBtn.className = 'btn btn-outline';
    printBtn.innerHTML = '<i class="fas fa-print"></i> Print';
    printBtn.addEventListener('click', () => window.print());
    
    // Add print button to actions
    const actionsBody = document.querySelector('.actions-card .card-body');
    if (actionsBody) {
        actionsBody.insertBefore(printBtn, actionsBody.lastElementChild);
    }
});
</script>