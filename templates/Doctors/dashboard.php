<?php
// Block access for non-doctors (including admins and patients)
if (!isset($currentUser) || $currentUser->role !== 'doctor') {
    echo '<div class="access-denied"><h4>Access Denied</h4><p>You do not have permission to view this page.</p></div>';
    return;
}
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.dashboard-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
}

/* Access Denied */
.access-denied {
    background: rgba(225, 29, 72, 0.1);
    border: 1px solid rgba(225, 29, 72, 0.2);
    border-radius: 12px;
    padding: 24px;
    margin: 20px;
    color: #e11d48;
    text-align: center;
}

/* Dashboard Header */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0 32px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.dashboard-title {
    font-size: 28px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
}

.doctor-badges {
    display: flex;
    gap: 12px;
    align-items: center;
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    border: none;
}

.badge-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
}

.badge-info {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
}

/* Alert Warning */
.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 32px;
    color: #f59e0b;
}

.alert-warning h5 {
    color: #d97706;
    margin-bottom: 12px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    padding: 24px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient);
}

.stat-card.primary {
    --gradient: linear-gradient(135deg, #0066cc, #004499);
}

.stat-card.success {
    --gradient: linear-gradient(135deg, #22c55e, #16a34a);
}

.stat-card.warning {
    --gradient: linear-gradient(135deg, #f59e0b, #d97706);
}

.stat-card.info {
    --gradient: linear-gradient(135deg, #06b6d4, #0891b2);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    background: var(--gradient);
}

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: #1f1f1f;
    margin-bottom: 4px;
}

.stat-label {
    color: #666;
    font-size: 14px;
    font-weight: 500;
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
}

/* Cards */
.card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.card-header {
    padding: 20px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(248, 249, 250, 0.5);
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    color: #1f1f1f;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
}

.card-body {
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
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.table th {
    font-weight: 600;
    color: #666;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(248, 249, 250, 0.5);
}

.table td {
    color: #1f1f1f;
}

.table tbody tr:hover {
    background: rgba(0, 102, 204, 0.02);
}

/* Status badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    gap: 4px;
}

.bg-primary { background: linear-gradient(135deg, #0066cc, #004499); color: white; }
.bg-success { background: linear-gradient(135deg, #22c55e, #16a34a); color: white; }
.bg-danger { background: linear-gradient(135deg, #e11d48, #be185d); color: white; }
.bg-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.bg-secondary { background: linear-gradient(135deg, #6b7280, #4b5563); color: white; }

/* Empty states */
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
}

/* List group */
.list-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.list-group-item {
    padding: 16px;
    background: rgba(248, 249, 250, 0.5);
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background: rgba(0, 102, 204, 0.05);
    border-color: #0066cc;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: inherit;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 12px;
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
}

.btn-outline-primary {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.btn-outline-primary:hover {
    background: #0066cc;
    color: white;
}

.btn-outline-secondary {
    background: transparent;
    color: #6b7280;
    border: 1px solid #6b7280;
}

.btn-outline-secondary:hover {
    background: #6b7280;
    color: white;
}

.btn-outline-success {
    background: transparent;
    color: #22c55e;
    border: 1px solid #22c55e;
}

.btn-outline-success:hover {
    background: #22c55e;
    color: white;
}

.btn-outline-info {
    background: transparent;
    color: #06b6d4;
    border: 1px solid #06b6d4;
}

.btn-outline-info:hover {
    background: #06b6d4;
    color: white;
}

.w-100 {
    width: 100%;
}

/* Quick Actions */
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

/* Profile card adjustments */
.profile-info p {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.profile-info strong {
    color: #1f1f1f;
    min-width: 80px;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 16px;
    }
    
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .doctor-badges {
        align-self: stretch;
    }
    
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Doctor Dashboard</h1>
        <?php if (isset($doctorInfo) && $doctorInfo): ?>
            <div class="doctor-badges">
                <span class="badge badge-success"><?= h($doctorInfo->name) ?></span>
                <?php if ($doctorInfo->department): ?>
                    <span class="badge badge-info"><?= h($doctorInfo->department->name) ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($currentUser) && !$currentUser->doctor_id): ?>
        <div class="alert-warning">
            <h5>Account Setup Required</h5>
            <p>Your doctor account is not fully set up. Please contact the hospital administration to complete your profile.</p>
            <p><strong>Username:</strong> <?= h($currentUser->username) ?></p>
            <p><strong>Role:</strong> <?= h($currentUser->role) ?></p>
        </div>
    <?php else: ?>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
            <div class="stat-value"><?= isset($todaysCount) ? $todaysCount : 0 ?></div>
            <div class="stat-label">Today's Appointments</div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-value">
                <?php
                $completedToday = 0;
                if (isset($todaysAppointments) && is_array($todaysAppointments)) {
                    foreach ($todaysAppointments as $appt) {
                        if ($appt->status === 'Completed') $completedToday++;
                    }
                }
                echo $completedToday;
                ?>
            </div>
            <div class="stat-label">Completed Today</div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-value">
                <?php
                $pendingToday = 0;
                if (isset($todaysAppointments) && is_array($todaysAppointments)) {
                    foreach ($todaysAppointments as $appt) {
                        if ($appt->status === 'Scheduled' || $appt->status === 'Pending') $pendingToday++;
                    }
                }
                echo $pendingToday;
                ?>
            </div>
            <div class="stat-label">Pending Today</div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
            </div>
            <div class="stat-value"><?= isset($upcomingAppointments) ? count($upcomingAppointments) : 0 ?></div>
            <div class="stat-label">Upcoming This Week</div>
        </div>
    </div>

    <div class="content-grid">
        <!-- Today's Schedule -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-day"></i>
                    Today's Schedule - <?= date('M d, Y') ?>
                </h5>
            </div>
            <div class="card-body">
                <?php if (isset($todaysAppointments) && !empty($todaysAppointments)): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todaysAppointments as $appointment): ?>
                                    <tr>
                                        <td>
                                            <strong><?= $appointment->appointment_time->format('g:i A') ?></strong>
                                        </td>
                                        <td>
                                            <strong><?= h($appointment->patient->name) ?></strong>
                                        </td>
                                        <td>
                                            <?= !empty($appointment->remarks) ? h($appointment->remarks) : '<em style="color: #666;">No remarks</em>' ?>
                                        </td>
                                        <td>
                                            <?php
                                                $statusClass = 'bg-secondary';
                                                switch($appointment->status) {
                                                    case 'Scheduled': $statusClass = 'bg-primary'; break;
                                                    case 'Completed': $statusClass = 'bg-success'; break;
                                                    case 'Cancelled': $statusClass = 'bg-danger'; break;
                                                    case 'No Show': $statusClass = 'bg-warning'; break;
                                                }
                                            ?>
                                            <span class="status-badge <?= $statusClass ?>"><?= h($appointment->status) ?></span>
                                        </td>
                                        <td>
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>', 
                                                ['controller' => 'Appointments', 'action' => 'view', $appointment->id], 
                                                ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']
                                            ) ?>
                                            <?= $this->Html->link(
                                                '<i class="fas fa-edit"></i>', 
                                                ['controller' => 'Appointments', 'action' => 'edit', $appointment->id], 
                                                ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false, 'title' => 'Edit']
                                            ) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h5>No appointments scheduled for today</h5>
                        <p>Enjoy your free day!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Column -->
        <div>
            <!-- Upcoming Appointments -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-calendar-week"></i>
                        Upcoming Appointments
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (isset($upcomingAppointments) && !empty($upcomingAppointments)): ?>
                        <div class="list-group">
                            <?php foreach ($upcomingAppointments as $appointment): ?>
                                <div class="list-group-item">
                                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                        <h6 style="margin: 0; font-weight: 600;"><?= h($appointment->patient->name) ?></h6>
                                        <small style="color: #666;"><?= $appointment->appointment_date->format('M d') ?></small>
                                    </div>
                                    <p style="margin: 0 0 4px 0; display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-clock" style="color: #666;"></i> 
                                        <?= $appointment->appointment_time->format('g:i A') ?>
                                    </p>
                                    <small style="color: #666;"><?= h($appointment->remarks ?: 'No remarks') ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div style="text-align: center; margin-top: 16px;">
                            <?= $this->Html->link(
                                'View All Appointments', 
                                ['controller' => 'Appointments', 'action' => 'index'], 
                                ['class' => 'btn btn-outline-primary btn-sm']
                            ) ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-calendar-check"></i>
                            <p>No upcoming appointments this week.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Doctor Info Card -->
            <?php if (isset($doctorInfo) && $doctorInfo): ?>
            <div class="card" style="margin-top: 24px;">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-user-md"></i>
                        My Profile
                    </h5>
                </div>
                <div class="card-body">
                    <div class="profile-info">
                        <p><strong>Name:</strong> Dr. <?= h($doctorInfo->name) ?></p>
                        <?php if ($doctorInfo->department): ?>
                        <p><strong>Department:</strong> <?= h($doctorInfo->department->name) ?></p>
                        <?php endif; ?>
                        <p><strong>Email:</strong> <?= h($currentUser->email ?? 'N/A') ?></p>
                    </div>
                    <div style="text-align: center; margin-top: 16px;">
                        <?= $this->Html->link(
                            'Edit Profile', 
                            ['action' => 'edit', $doctorInfo->id], 
                            ['class' => 'btn btn-outline-primary btn-sm']
                        ) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-tachometer-alt"></i>
                Quick Actions
            </h5>
        </div>
        <div class="card-body">
            <div class="quick-actions-grid">
                <?= $this->Html->link(
                    '<i class="fas fa-list"></i> All Appointments', 
                    ['controller' => 'Appointments', 'action' => 'index'], 
                    ['class' => 'btn btn-primary', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-users"></i> Patients', 
                    ['controller' => 'Patients', 'action' => 'index'], 
                    ['class' => 'btn btn-outline-primary', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-calendar-plus"></i> Schedule', 
                    ['controller' => 'Appointments', 'action' => 'add'], 
                    ['class' => 'btn btn-outline-success', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-chart-bar"></i> Reports', 
                    ['controller' => 'Reports', 'action' => 'index'], 
                    ['class' => 'btn btn-outline-info', 'escape' => false]
                ) ?>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div>