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

.status-completed { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
.status-cancelled { background: rgba(225, 29, 72, 0.1); color: #e11d48; }
.status-no-show { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
.status-scheduled { background: rgba(0, 102, 204, 0.1); color: #0066cc; }
.status-confirmed { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.status-in-progress { background: rgba(168, 85, 247, 0.1); color: #a855f7; }
.status-pending-approval { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

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

.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    box-shadow: 0 4px 16px rgba(34, 197, 94, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
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
    background: linear-gradient(135deg, #e11d48, #be123c);
    color: white;
    box-shadow: 0 4px 16px rgba(225, 29, 72, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #be123c, #9f1239);
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
.datetime-value { font-weight: 500; color: #1f1f1f; }
.date-value { color: #0066cc; font-weight: 600; }
.time-value { color: #22c55e; font-weight: 600; }

/* Responsive Design */
@media (max-width: 1024px) {
    .content-grid { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
    .view-container { padding: 20px 16px; }
    .page-header { flex-direction: column; align-items: flex-start; gap: 20px; padding: 24px; }
    .header-actions { align-self: stretch; }
    .header-actions .btn { flex: 1; }
}

/* Status History Timeline */
.status-history-timeline {
    position: relative;
    padding-left: 30px;
}

.status-history-timeline::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: rgba(0, 0, 0, 0.1);
}

.history-item {
    position: relative;
    margin-bottom: 24px;
    display: flex;
    gap: 16px;
}

.history-item:last-child { margin-bottom: 0; }

.history-icon {
    position: absolute;
    left: -22px;
    top: 4px;
    width: 16px;
    height: 16px;
    background: white;
    border: 2px solid #0066cc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.history-icon i { font-size: 6px; color: #0066cc; }
.history-content { flex: 1; }
.history-status { margin-bottom: 8px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.history-change { font-size: 12px; color: #666; }
.history-meta { display: flex; gap: 12px; font-size: 12px; color: #666; margin-bottom: 4px; }
.history-user { font-weight: 500; color: #0066cc; }
.history-notes { margin-top: 8px; padding: 8px 12px; background: rgba(248, 249, 250, 0.8); border-radius: 6px; font-size: 13px; color: #666; border-left: 3px solid #0066cc; }

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    background: white;
    margin: 10% auto;
    padding: 0;
    border-radius: 16px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.modal-header {
    padding: 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title { font-size: 20px; font-weight: 600; color: #1f1f1f; margin: 0; }
.modal-close { background: none; border: none; font-size: 24px; color: #666; cursor: pointer; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.2s ease; }
.modal-close:hover { background: rgba(0, 0, 0, 0.1); color: #1f1f1f; }
.modal-body { padding: 24px; }
.modal-footer { padding: 16px 24px; border-top: 1px solid rgba(0, 0, 0, 0.1); display: flex; justify-content: flex-end; gap: 12px; }
.modal-footer .btn { width: auto; margin-bottom: 0; }

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #1f1f1f;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
}

.form-control:focus {
    outline: none;
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

@media print {
    body::before { display: none; }
    .page-header, .info-card, .actions-card { background: white !important; box-shadow: none !important; border: 1px solid #ddd !important; }
    .actions-card { display: none; }
    .modal { display: none !important; }
}
</style>

<div class="view-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-calendar-alt"></i>
            Appointment Details
        </h1>
        <div class="header-actions">
            <?php if (isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor'])): ?>
                <?= $this->Html->link(
                    '<i class="fas fa-edit"></i> Edit',
                    ['action' => 'edit', $appointment->id],
                    ['class' => 'btn btn-primary', 'escape' => false]
                ) ?>
            <?php endif; ?>
            <?= $this->Html->link(
                '<i class="fas fa-arrow-left"></i> Back to List',
                ['action' => 'index'],
                ['class' => 'btn btn-secondary', 'escape' => false]
            ) ?>
        </div>
    </div>

    <div class="content-grid">
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
                        <td><span class="id-badge">#<?= $this->Number->format($appointment->id) ?></span></td>
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
                        <td><span class="date-value"><?= h($appointment->appointment_date->format('M d, Y')) ?></span></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-clock"></i> Time:</th>
                        <td><span class="time-value"><?= h($appointment->appointment_time->format('H:i A')) ?></span></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-hourglass-half"></i> Duration:</th>
                        <td><span class="datetime-value"><?= h($appointment->duration_minutes ?? 30) ?> minutes</span></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-flag"></i> Status:</th>
                        <td>
                            <?php
                            $statusClass = 'status-scheduled';
                            $statusIcon = 'fas fa-calendar';
                            
                            switch ($appointment->status) {
                                case 'Confirmed': $statusClass = 'status-confirmed'; $statusIcon = 'fas fa-check-circle'; break;
                                case 'In Progress': $statusClass = 'status-in-progress'; $statusIcon = 'fas fa-spinner'; break;
                                case 'Completed': $statusClass = 'status-completed'; $statusIcon = 'fas fa-check-circle'; break;
                                case 'Cancelled': $statusClass = 'status-cancelled'; $statusIcon = 'fas fa-times-circle'; break;
                                case 'No Show': $statusClass = 'status-no-show'; $statusIcon = 'fas fa-exclamation-triangle'; break;
                                case 'Pending Approval': $statusClass = 'status-pending-approval'; $statusIcon = 'fas fa-clock'; break;
                                default: $statusClass = 'status-scheduled'; $statusIcon = 'fas fa-calendar-check';
                            }
                            ?>
                            <span class="status-badge <?= $statusClass ?>">
                                <i class="<?= $statusIcon ?>"></i>
                                <?= h($appointment->status) ?>
                            </span>
                        </td>
                    </tr>
                    <?php if ($appointment->has('cancelledByUser') && $appointment->cancelledByUser): ?>
                    <tr>
                        <th><i class="fas fa-user-times"></i> Cancelled By:</th>
                        <td>
                            <span class="datetime-value"><?= h($appointment->cancelledByUser->username) ?></span>
                            <?php if ($appointment->cancelled_at): ?>
                                <span class="datetime-value" style="color: #666; margin-left: 8px;">
                                    on <?= h($appointment->cancelled_at->format('M d, Y H:i A')) ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!empty($appointment->cancellation_reason)): ?>
                    <tr>
                        <th><i class="fas fa-comment-alt"></i> Cancellation Reason:</th>
                        <td>
                            <div class="remarks-content" style="background: rgba(225, 29, 72, 0.05); border-left-color: #e11d48;">
                                <?= h($appointment->cancellation_reason) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th><i class="fas fa-sticky-note"></i> Remarks:</th>
                        <td>
                            <?php if (!empty($appointment->remarks)): ?>
                                <div class="remarks-content"><?= h($appointment->remarks) ?></div>
                            <?php else: ?>
                                <span class="no-remarks">No remarks</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-plus"></i> Created:</th>
                        <td><span class="datetime-value"><?= h($appointment->created_at->format('M d, Y H:i A')) ?></span></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-edit"></i> Updated:</th>
                        <td><span class="datetime-value"><?= h($appointment->updated_at->format('M d, Y H:i A')) ?></span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="actions-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-bolt"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <?php if (isset($allowedTransitions) && !empty($allowedTransitions)): ?>
                    <div class="workflow-actions" style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(0,0,0,0.1);">
                        <h6 style="margin-bottom: 12px; font-size: 14px; font-weight: 600; color: #1f1f1f;">
                            <i class="fas fa-sync-alt"></i> Status Actions
                        </h6>

                        <?php 
                        // Helper flags
                        $isPending = $appointment->status === 'Pending Approval';
                        $hasCancellationRequest = !empty($appointment->cancellation_reason);
                        $isCancellationReview = $isPending && $hasCancellationRequest;
                        $isNewRequest = $isPending && !$hasCancellationRequest;
                        $isAdminOrDoctor = isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor']);
                        ?>

                        <?php if ($isCancellationReview): ?>
                            <?php if ($isAdminOrDoctor): ?>
                                <div class="alert alert-warning" style="padding: 10px; margin-bottom: 10px; font-size: 13px;">
                                    <strong><i class="fas fa-exclamation-circle"></i> Patient requested cancellation:</strong><br>
                                    "<?= h($appointment->cancellation_reason) ?>"
                                </div>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-check"></i> Approve Cancellation',
                                    ['action' => 'approveCancellation', $appointment->id],
                                    [
                                        'class' => 'btn btn-danger',
                                        'style' => 'margin-bottom: 8px;',
                                        'escape' => false,
                                        'confirm' => __('Are you sure you want to approve this cancellation?')
                                    ]
                                ) ?>
                                <button type="button" class="btn btn-secondary" style="margin-bottom: 8px;" onclick="showRejectModal()">
                                    <i class="fas fa-undo"></i> Reject Request
                                </button>
                            <?php endif; ?>

                        <?php else: ?>
                            
                            <?php if (in_array('Confirmed', $allowedTransitions) && $isAdminOrDoctor): ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-check"></i> Confirm Appointment',
                                    ['action' => 'confirm', $appointment->id],
                                    [
                                        'class' => 'btn btn-primary',
                                        'style' => 'margin-bottom: 8px;',
                                        'escape' => false,
                                        'confirm' => __('Are you sure you want to confirm this appointment?')
                                    ]
                                ) ?>
                            <?php endif; ?>

                            <?php if (in_array('In Progress', $allowedTransitions) && $isAdminOrDoctor): ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-play"></i> Start Appointment',
                                    ['action' => 'start', $appointment->id],
                                    [
                                        'class' => 'btn btn-primary',
                                        'style' => 'margin-bottom: 8px;',
                                        'escape' => false,
                                        'confirm' => __('Are you sure you want to start this appointment?')
                                    ]
                                ) ?>
                            <?php endif; ?>

                            <?php if (in_array('Completed', $allowedTransitions) && $isAdminOrDoctor): ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-check-circle"></i> Mark Completed',
                                    ['action' => 'complete', $appointment->id],
                                    [
                                        'class' => 'btn btn-success',
                                        'style' => 'margin-bottom: 8px;',
                                        'escape' => false,
                                        'confirm' => __('Are you sure you want to mark this appointment as completed?')
                                    ]
                                ) ?>
                            <?php endif; ?>

                            <?php 
                            if (in_array('Pending Approval', $allowedTransitions) || in_array('Cancelled', $allowedTransitions)): 
                                if ($isAdminOrDoctor) {
                                    // Doctor Logic: "Decline" new requests, "Cancel" existing ones
                                    $btnLabel = $isNewRequest ? 'Decline Request' : 'Cancel Appointment';
                                    $btnIcon = $isNewRequest ? 'fas fa-times' : 'fas fa-ban';
                                    ?>
                                    <button type="button" class="btn btn-outline-danger" style="margin-bottom: 8px;" onclick="showCancelModal()">
                                        <i class="<?= $btnIcon ?>"></i> <?= $btnLabel ?>
                                    </button>
                                    <?php
                                } // Logic for PATIENT
                                elseif ($currentUser->role === 'patient') {
                                    // Check if we can Cancel directly OR Request Approval
                                    $canCancel = in_array('Cancelled', $allowedTransitions);
                                    $canRequest = in_array('Pending Approval', $allowedTransitions);
                                    
                                    if ($canCancel || $canRequest) {
                                        // 1. Withdraw: New request waiting for doctor (Pending -> Cancelled)
                                        if ($isNewRequest && $canCancel) {
                                            $label = 'Withdraw Request';
                                            $icon = 'fas fa-trash';
                                            $confirm = 'Are you sure you want to withdraw this appointment request?';
                                        } 
                                        // 2. Request Cancellation: Confirmed appointment (Confirmed -> Pending)
                                        elseif ($appointment->status === 'Confirmed') {
                                            $label = 'Request Cancellation';
                                            $icon = 'fas fa-flag';
                                            $confirm = null; // Modal will handle confirmation
                                        } 
                                        // 3. Cancel: Scheduled but not confirmed (Scheduled -> Cancelled)
                                        else {
                                            $label = 'Cancel Appointment';
                                            $icon = 'fas fa-times';
                                            $confirm = 'Are you sure you want to cancel this appointment?';
                                        }
                                        ?>
                                        
                                        <?php if ($label === 'Withdraw Request'): ?>
                                            <?= $this->Form->postLink(
                                                '<i class="' . $icon . '"></i> ' . $label,
                                                ['action' => 'cancel', $appointment->id],
                                                [
                                                    'class' => 'btn btn-outline-danger',
                                                    'style' => 'margin-bottom: 8px;',
                                                    'escape' => false,
                                                    'confirm' => $confirm
                                                ]
                                            ) ?>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-outline-danger" style="margin-bottom: 8px;" onclick="showCancelModal()">
                                                <i class="<?= $icon ?>"></i> <?= $label ?>
                                            </button>
                                        <?php endif; ?>
    
                                        <?php
                                    }
                                }
                            endif;  ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($currentUser) && in_array($currentUser->role, ['admin', 'doctor'])): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-edit"></i> Edit Appointment',
                        ['action' => 'edit', $appointment->id],
                        ['class' => 'btn btn-primary', 'escape' => false, 'style' => 'margin-bottom: 8px;']
                    ) ?>
                <?php endif; ?>
                
                <?php if ($appointment->has('patient')): ?>
                <?= $this->Html->link(
                    '<i class="fas fa-user"></i> View Patient',
                    ['controller' => 'Patients', 'action' => 'view', $appointment->patient->id],
                    ['class' => 'btn btn-outline', 'escape' => false, 'style' => 'margin-bottom: 8px;']
                ) ?>
                <?php endif; ?>
                
                <?php if ($appointment->has('doctor')): ?>
                <?= $this->Html->link(
                    '<i class="fas fa-user-md"></i> View Doctor',
                    ['controller' => 'Doctors', 'action' => 'view', $appointment->doctor->id],
                    ['class' => 'btn btn-outline', 'escape' => false, 'style' => 'margin-bottom: 8px;']
                ) ?>
                <?php endif; ?>
                
                <?= $this->Html->link(
                    '<i class="fas fa-list"></i> All Appointments',
                    ['action' => 'index'],
                    ['class' => 'btn btn-outline', 'escape' => false, 'style' => 'margin-bottom: 8px;']
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

    <?php if (isset($statusHistory) && !empty($statusHistory)): ?>
    <div class="info-card" style="margin-top: 32px;">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-history"></i>
                Status History
            </h5>
        </div>
        <div class="card-body">
            <div class="status-history-timeline">
                <?php foreach ($statusHistory as $history): ?>
                    <div class="history-item">
                        <div class="history-icon">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="history-content">
                            <div class="history-status">
                                <span class="status-badge status-<?= strtolower(str_replace(' ', '-', $history->new_status)) ?>">
                                    <?= h($history->new_status) ?>
                                </span>
                                <?php if ($history->old_status): ?>
                                    <span class="history-change">from <?= h($history->old_status) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="history-meta">
                                <span class="history-user"><?= h($history->changedByUser->username ?? 'System') ?></span>
                                <span class="history-date"><?= h($history->changed_at->format('M d, Y H:i A')) ?></span>
                            </div>
                            <?php if (!empty($history->notes)): ?>
                                <div class="history-notes"><?= h($history->notes) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div id="cancelModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Request Cancellation</h5>
            <button class="modal-close" onclick="closeCancelModal()">&times;</button>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['action' => 'requestCancellation', $appointment->id], 'id' => 'cancelForm']) ?>
            <div class="form-group">
                <label for="cancelReason">Reason <span style="color: #e11d48;">*</span></label>
                <?= $this->Form->textarea('reason', ['id' => 'cancelReason', 'class' => 'form-control', 'rows' => 4, 'required' => true, 'placeholder' => 'Please provide a reason...']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeCancelModal()">Cancel</button>
            <button type="submit" form="cancelForm" class="btn btn-danger">Submit</button>
        </div>
    </div>
</div>

<div id="rejectModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Reject Cancellation Request</h5>
            <button class="modal-close" onclick="closeRejectModal()">&times;</button>
        </div>
        <div class="modal-body">
            <?= $this->Form->create(null, ['url' => ['action' => 'rejectCancellation', $appointment->id], 'id' => 'rejectForm']) ?>
            <div class="form-group">
                <label for="rejectReason">Reason <span style="color: #e11d48;">*</span></label>
                <?= $this->Form->textarea('reason', ['id' => 'rejectReason', 'class' => 'form-control', 'rows' => 4, 'required' => true, 'placeholder' => 'Please provide a reason for rejecting...']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeRejectModal()">Cancel</button>
            <button type="submit" form="rejectForm" class="btn btn-danger">Reject</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Logic
    const modals = { 'cancel': document.getElementById('cancelModal'), 'reject': document.getElementById('rejectModal') };
    
    window.showCancelModal = () => { modals.cancel.style.display = 'block'; setTimeout(() => document.getElementById('cancelReason').focus(), 100); };
    window.closeCancelModal = () => { modals.cancel.style.display = 'none'; const f=document.getElementById('cancelForm'); if(f)f.reset(); };
    
    window.showRejectModal = () => { modals.reject.style.display = 'block'; setTimeout(() => document.getElementById('rejectReason').focus(), 100); };
    window.closeRejectModal = () => { modals.reject.style.display = 'none'; const f=document.getElementById('rejectForm'); if(f)f.reset(); };

    // Close on outside click or Escape
    window.addEventListener('click', (e) => {
        if (e.target === modals.cancel) window.closeCancelModal();
        if (e.target === modals.reject) window.closeRejectModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { window.closeCancelModal(); window.closeRejectModal(); }
    });

    // ID Copy
    const idBadge = document.querySelector('.id-badge');
    if (idBadge) {
        idBadge.style.cursor = 'pointer';
        idBadge.title = 'Click to copy ID';
        idBadge.addEventListener('click', function() {
            const idText = this.textContent.replace('#', '');
            navigator.clipboard.writeText(idText).then(() => {
                const orig = this.textContent;
                this.textContent = 'Copied!';
                this.style.background = 'rgba(34, 197, 94, 0.1)';
                this.style.color = '#22c55e';
                setTimeout(() => {
                    this.textContent = orig;
                    this.style.background = 'rgba(0, 102, 204, 0.1)';
                    this.style.color = '#0066cc';
                }, 1000);
            });
        });
    }
    
    // Print
    const printBtn = document.createElement('button');
    printBtn.className = 'btn btn-outline';
    printBtn.innerHTML = '<i class="fas fa-print"></i> Print';
    printBtn.onclick = () => window.print();
    const actionsBody = document.querySelector('.actions-card .card-body');
    if (actionsBody) actionsBody.appendChild(printBtn);
});
</script>