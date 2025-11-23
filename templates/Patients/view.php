<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.patient-view-container {
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

/* Patient Info Card */
.patient-info-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 32px;
}

.patient-info-header {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.patient-avatar {
    width: 64px;
    height: 64px;
    border-radius: 32px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
}

.patient-basic-info h3 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 4px;
}

.patient-basic-info p {
    opacity: 0.9;
    font-size: 16px;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.patient-details {
    padding: 24px;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-size: 12px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 14px;
    color: #1f1f1f;
    font-weight: 500;
}

.detail-value a {
    color: #0066cc;
    text-decoration: none;
    transition: color 0.2s ease;
}

.detail-value a:hover {
    color: #0052a3;
    text-decoration: underline;
}


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

.gender-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: capitalize;
}

.gender-badge.male {
    background: rgba(59, 130, 246, 0.1);
    color: #white;
}

.gender-badge.female {
    background: rgba(236, 72, 153, 0.1);
    color: #ec4899;
}

.gender-badge.other {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
}

/* Age display */
.age-display {
    color: #ffffff;
    font-size: 13px;
    font-style: italic;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 32px;
}

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

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #e11d48, #be185d);
    color: white;
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.2);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #be185d, #9f1239);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(225, 29, 72, 0.3);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    box-shadow: 0 2px 8px rgba(107, 114, 128, 0.2);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #4b5563, #374151);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    color: white;
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

/* Related Appointments Section */
.related-section {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.related-header {
    padding: 20px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(248, 249, 250, 0.5);
}

.related-title {
    font-size: 18px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.related-title i {
    color: #0066cc;
}

.related-body {
    padding: 24px;
}

/* Table */
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
    padding: 12px;
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

.table td {
    color: #1f1f1f;
    font-size: 13px;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background: rgba(0, 102, 204, 0.02);
    transform: translateX(2px);
}

/* Doctor Links */
.doctor-link {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.doctor-link:hover {
    color: #0052a3;
    text-decoration: underline;
}

/* Appointment Status Badges */
.appointment-status {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.appointment-status.scheduled {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.appointment-status.completed {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.appointment-status.cancelled {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.appointment-status.no-show {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.appointment-status.confirmed {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.appointment-status.in-progress {
    background: rgba(168, 85, 247, 0.1);
    color: #a855f7;
}

.appointment-status.pending-approval {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.appointment-status i {
    font-size: 10px;
    margin-right: 4px;
}

/* Action Buttons in Table */
.table-action-buttons {
    display: flex;
    gap: 4px;
    align-items: center;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #666;
}

.empty-state i {
    font-size: 48px;
    margin-bottom: 16px;
    color: #ccc;
}

.empty-state h5 {
    color: #1f1f1f;
    margin-bottom: 8px;
    font-weight: 600;
}

.empty-state p {
    color: #666;
    font-size: 14px;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .patient-view-container {
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
    
    .patient-info-header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn {
        justify-content: center;
    }
    
    .table th,
    .table td {
        padding: 8px 6px;
        font-size: 11px;
    }
    
    .table-action-buttons {
        flex-direction: column;
        gap: 2px;
    }
    
    /* Hide some columns on mobile */
    .table th:nth-child(1),
    .table td:nth-child(1),
    .table th:nth-child(2),
    .table td:nth-child(2),
    .table th:nth-child(3),
    .table td:nth-child(3),
    .table th:nth-child(8),
    .table td:nth-child(8),
    .table th:nth-child(9),
    .table td:nth-child(9) {
        display: none;
    }
}

@media (max-width: 480px) {
    .patient-avatar {
        width: 48px;
        height: 48px;
        font-size: 18px;
    }
    
    .patient-basic-info h3 {
        font-size: 20px;
    }
    
    .table th:nth-child(7),
    .table td:nth-child(7) {
        display: none; /* Hide remarks column on very small screens */
    }
}
</style>

<div class="patient-view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user"></i>
            Patient Profile
        </h3>
    </div>

    <!-- Patient Info Card -->
    <div class="patient-info-card">
        <div class="patient-info-header">
            <div class="patient-avatar">
                <?= strtoupper(substr($patient->name, 0, 1)) ?>
            </div>
            <div class="patient-basic-info">
                <h3><?= h($patient->name) ?></h3>
                <p>
                    <?php if ($patient->gender): ?>
                        <span class="gender-badge <?= strtolower($patient->gender) ?>">
                            <?= h($patient->gender) ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($patient->dob): ?>
                        <span class="age-display">
                            Age: <?= $patient->dob->diff(\Cake\I18n\FrozenDate::now())->y ?> years
                        </span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="patient-details">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Patient ID</div>
                    <div class="detail-value"><?= $this->Number->format($patient->id) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value"><?= h($patient->name) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Gender</div>
                    <div class="detail-value">
                        <?php if ($patient->gender): ?>
                            <span class="gender-badge <?= strtolower($patient->gender) ?>">
                                <?= h($patient->gender) ?>
                            </span>
                        <?php else: ?>
                            Not Specified
                        <?php endif; ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Date of Birth</div>
                    <div class="detail-value">
                        <?php if ($patient->dob): ?>
                            <?= h($patient->dob->format('M d, Y')) ?>
                            <div class="age-display">Age: <?= $patient->dob->diff(\Cake\I18n\FrozenDate::now())->y ?> years</div>
                        <?php else: ?>
                            Not Provided
                        <?php endif; ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Contact Number</div>
                    <div class="detail-value">
                        <?php if ($patient->contact_number): ?>
                            <a href="tel:<?= h($patient->contact_number) ?>"><?= h($patient->contact_number) ?></a>
                        <?php else: ?>
                            Not Provided
                        <?php endif; ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email Address</div>
                    <div class="detail-value">
                        <?php if ($patient->email): ?>
                            <a href="mailto:<?= h($patient->email) ?>"><?= h($patient->email) ?></a>
                        <?php else: ?>
                            Not Provided
                        <?php endif; ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <span class="status-badge <?= strtolower($patient->status ?? 'active') ?>">
                            <?= h($patient->status ?? 'Active') ?>
                        </span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Created</div>
                    <div class="detail-value">
                        <?= h($patient->created_at ? $patient->created_at->format('M d, Y g:i A') : 'N/A') ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Last Updated</div>
                    <div class="detail-value">
                        <?= h($patient->updated_at ? $patient->updated_at->format('M d, Y g:i A') : 'N/A') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <?php if (isset($currentUser)) : ?>
            <?php if ($currentUser->role === 'admin' || $currentUser->role === 'receptionist'): ?>
                <?= $this->Html->link('<i class="fas fa-edit"></i> Edit Patient', ['action' => 'edit', $patient->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
                <?= $this->Form->postLink('<i class="fas fa-trash"></i> Delete Patient', ['action' => 'delete', $patient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $patient->id), 'class' => 'btn btn-danger', 'escape' => false]) ?>
                <?= $this->Html->link('<i class="fas fa-list"></i> List Patients', ['action' => 'index'], ['class' => 'btn btn-secondary', 'escape' => false]) ?>
                <?= $this->Html->link('<i class="fas fa-user-plus"></i> New Patient', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
            <?php elseif ($currentUser->role === 'patient' && $currentUser->patient_id == $patient->id): ?>
                <?= $this->Html->link('<i class="fas fa-edit"></i> Edit Profile', ['action' => 'edit', $patient->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            <?php elseif ($currentUser->role !== 'doctor'): ?>
                <?= $this->Html->link('<i class="fas fa-list"></i> List Patients', ['action' => 'index'], ['class' => 'btn btn-secondary', 'escape' => false]) ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Related Appointments -->
    <div class="related-section">
        <div class="related-header">
            <h4 class="related-title">
                <i class="fas fa-calendar-check"></i>
                Related Appointments
            </h4>
        </div>
        <div class="related-body">
            <?php if (!empty($patient->appointments)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient ID</th>
                                <th>Doctor ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Duration</th>
                                <th>Remarks</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patient->appointments as $appointment): ?>
                            <tr>
                                <td><?= h($appointment->id) ?></td>
                                <td><?= h($appointment->patient_id) ?></td>
                                <td><?= h($appointment->doctor_id) ?></td>
                                <td><?= h($appointment->appointment_date ? $appointment->appointment_date->format('M d, Y') : 'N/A') ?></td>
                                <td><?= h($appointment->appointment_time ? $appointment->appointment_time->format('g:i A') : 'N/A') ?></td>
                                <td>
                                    <?php
                                    $status = $appointment->status ?? 'Scheduled';
                                    $statusClass = 'scheduled';
                                    $statusIcon = 'fa-calendar-check';
                                    switch($status) {
                                        case 'Confirmed':
                                            $statusClass = 'confirmed';
                                            $statusIcon = 'fa-check-circle';
                                            break;
                                        case 'In Progress':
                                            $statusClass = 'in-progress';
                                            $statusIcon = 'fa-spinner';
                                            break;
                                        case 'Completed':
                                            $statusClass = 'completed';
                                            $statusIcon = 'fa-check-circle';
                                            break;
                                        case 'Cancelled':
                                            $statusClass = 'cancelled';
                                            $statusIcon = 'fa-times-circle';
                                            break;
                                        case 'No Show':
                                            $statusClass = 'no-show';
                                            $statusIcon = 'fa-exclamation-triangle';
                                            break;
                                        case 'Pending Approval':
                                            $statusClass = 'pending-approval';
                                            $statusIcon = 'fa-clock';
                                            break;
                                        default:
                                            $statusClass = 'scheduled';
                                            $statusIcon = 'fa-calendar-check';
                                    }
                                    ?>
                                    <span class="appointment-status <?= $statusClass ?>">
                                        <i class="fas <?= $statusIcon ?>"></i>
                                        <?= h($status) ?>
                                    </span>
                                </td>
                                <td><?= h($appointment->duration_minutes ?? 30) ?> min</td>
                                <td><?= h($appointment->remarks ?: '-') ?></td>
                                <td><?= h($appointment->created_at ? $appointment->created_at->format('M d, Y') : 'N/A') ?></td>
                                <td><?= h($appointment->updated_at ? $appointment->updated_at->format('M d, Y') : 'N/A') ?></td>
                                <td>
                                    <div class="table-action-buttons">
                                        <?= $this->Html->link('<i class="fas fa-eye"></i>', ['controller' => 'Appointments', 'action' => 'view', $appointment->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                        <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                                            <?= $this->Html->link('<i class="fas fa-edit"></i>', ['controller' => 'Appointments', 'action' => 'edit', $appointment->id], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false]) ?>
                                            <?= $this->Form->postLink(
                                                '<i class="fas fa-trash"></i>',
                                                ['controller' => 'Appointments', 'action' => 'delete', $appointment->id],
                                                [
                                                    'method' => 'delete',
                                                    'confirm' => __('Are you sure you want to delete # {0}?', $appointment->id),
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
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h5>No appointments found</h5>
                    <p>This patient has no related appointments yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>