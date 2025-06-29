<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.patient-dashboard-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
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
    display: flex;
    align-items: center;
    gap: 12px;
}

.dashboard-title i {
    color: #0066cc;
}

/* Alert Warning */
.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.2);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 32px;
    border-left: 4px solid #f59e0b;
}

.alert-warning h5 {
    color: #d97706;
    margin-bottom: 12px;
    font-weight: 600;
}

.alert-warning p {
    color: #92400e;
    margin-bottom: 8px;
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
    margin-bottom: 24px;
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

/* List Groups */
.list-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
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
    transform: translateX(4px);
}

.list-group-item h6 {
    font-weight: 600;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.list-group-item p {
    margin-bottom: 4px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 8px;
}

.list-group-item small {
    color: #666;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Status Badges */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge.primary {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.badge.secondary {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
}

.badge.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.badge.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.badge.danger {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

/* Empty States */
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
    margin-bottom: 12px;
    font-weight: 600;
}

.empty-state p {
    color: #666;
    font-size: 14px;
    margin-bottom: 16px;
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
    padding: 8px 12px;
    font-size: 12px;
}

.btn-lg {
    padding: 12px 20px;
    font-size: 16px;
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

.btn-outline-info {
    background: transparent;
    color: #06b6d4;
    border: 1px solid #06b6d4;
}

.btn-outline-info:hover {
    background: #06b6d4;
    color: white;
    transform: translateY(-1px);
}

/* Profile Info */
.profile-info p {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.profile-info strong {
    color: #1f1f1f;
    min-width: 60px;
}

/* Quick Actions */
.quick-actions-section {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    padding: 24px;
}

.quick-action-btn {
    min-height: 60px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.quick-action-btn:hover {
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .patient-dashboard-container {
        padding: 16px;
    }
    
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .dashboard-title {
        font-size: 24px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
    
    .card-body {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .stat-card {
        padding: 20px;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .stat-value {
        font-size: 24px;
    }
    
    .card-header {
        padding: 16px 20px;
    }
    
    .card-body {
        padding: 16px;
    }
}
</style>

<div class="patient-dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-user"></i>
            Patient Dashboard
        </h1>
    </div>

    <?php if (isset($currentUser) && !$currentUser->patient_id): ?>
        <div class="alert-warning">
            <h5>Account Setup Required</h5>
            <p>Your patient account is not fully set up. Please contact the hospital administration to complete your profile.</p>
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
            <div class="stat-value"><?= isset($todaysAppointments) ? count($todaysAppointments) : 0 ?></div>
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
        <!-- Upcoming Appointments -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-plus"></i>
                    My Upcoming Appointments
                </h5>
            </div>
            <div class="card-body">
                <?php if (isset($upcomingAppointments) && !empty($upcomingAppointments)): ?>
                    <div class="list-group">
                        <?php foreach ($upcomingAppointments as $appointment): ?>
                            <div class="list-group-item">
                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                    <h6 style="margin: 0;">
                                        <i class="fas fa-user-md"></i> 
                                        Dr. <?= h($appointment->doctor->name) ?>
                                    </h6>
                                    <small style="color: #666;"><?= $appointment->appointment_date->format('M d, Y') ?></small>
                                </div>
                                <p>
                                    <i class="fas fa-clock"></i> 
                                    <?= $appointment->appointment_time->format('g:i A') ?>
                                </p>
                                <?php if (isset($appointment->doctor->department) && $appointment->doctor->department): ?>
                                <p>
                                    <i class="fas fa-building"></i> 
                                    <?= h($appointment->doctor->department->name) ?>
                                </p>
                                <?php endif; ?>
                                <small>
                                    Status: 
                                    <span class="badge primary"><?= h($appointment->status) ?></span>
                                </small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <h5>No upcoming appointments</h5>
                        <p>Schedule your next appointment with one of our doctors.</p>
                        <?= $this->Html->link(
                            '<i class="fas fa-plus"></i> Schedule Appointment', 
                            ['controller' => 'Appointments', 'action' => 'add'], 
                            ['class' => 'btn btn-primary', 'escape' => false]
                        ) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Recent Appointments -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-history"></i>
                        Recent Appointments
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (isset($myAppointments) && !empty($myAppointments)): ?>
                        <div class="list-group">
                            <?php foreach ($myAppointments as $appointment): ?>
                                <div class="list-group-item">
                                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                        <h6 style="margin: 0;">
                                            <i class="fas fa-user-md"></i> 
                                            Dr. <?= h($appointment->doctor->name) ?>
                                        </h6>
                                        <small style="color: #666;"><?= $appointment->appointment_date->format('M d, Y') ?></small>
                                    </div>
                                    <p>
                                        <i class="fas fa-clock"></i> 
                                        <?= $appointment->appointment_time->format('g:i A') ?>
                                    </p>
                                    <?php if (!empty($appointment->remarks)): ?>
                                    <p>
                                        <i class="fas fa-sticky-note"></i> 
                                        <?= h($appointment->remarks) ?>
                                    </p>
                                    <?php endif; ?>
                                    <small>
                                        Status: 
                                        <span class="badge secondary"><?= h($appointment->status) ?></span>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-folder-open"></i>
                            <p>No appointment history available.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- My Profile -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-user"></i>
                        My Profile
                    </h5>
                </div>
                <div class="card-body">
                    <div class="profile-info">
                        <?php if (!empty($patientInfo) && !empty($patientInfo->name)): ?>
                        <p><strong>Name:</strong> <?= h($patientInfo->name) ?></p>
                        <?php endif; ?>
                        <p><strong>Email:</strong> <?= h($currentUser->email ?? 'N/A') ?></p>
                    </div>
                    <div style="text-align: center; margin-top: 16px;">
                        <?= $this->Html->link(
                            '<i class="fas fa-edit"></i> Edit Profile', 
                            ['controller' => 'Patients', 'action' => 'edit', $patientInfo->id], 
                            ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-section">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-tachometer-alt"></i>
                Quick Actions
            </h5>
        </div>
        <div class="quick-actions-grid">
            <?= $this->Html->link(
                '<i class="fas fa-plus"></i> Schedule Appointment',
                ['controller' => 'Appointments', 'action' => 'add'],
                ['escape' => false, 'class' => 'btn btn-lg btn-primary quick-action-btn']
            ) ?>
            <?= $this->Html->link(
                '<i class="fas fa-list"></i> View All Appointments',
                ['controller' => 'Appointments', 'action' => 'index'],
                ['escape' => false, 'class' => 'btn btn-lg btn-outline-primary quick-action-btn']
            ) ?>
            <?= $this->Html->link(
                '<i class="fas fa-user-md"></i> Find Doctors',
                ['controller' => 'Doctors', 'action' => 'index'],
                ['escape' => false, 'class' => 'btn btn-lg btn-outline-info quick-action-btn']
            ) ?>
        </div>
    </div>

    <?php endif; ?>
</div>