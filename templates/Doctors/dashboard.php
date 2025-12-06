<?php
// Block access for non-doctors
if (!isset($currentUser) || $currentUser->role !== 'doctor') {
    echo '<div class="alert alert-danger m-4"><h4>Access Denied</h4><p>You do not have permission to view this page.</p></div>';
    return;
}
?>

<div class="dashboard-container">
    <div class="dashboard-header mb-4">
        <h1 class="dashboard-title">Doctor Dashboard</h1>
        <?php if (isset($doctorInfo) && $doctorInfo): ?>
            <div class="d-flex gap-2">
                <span class="status-badge badge-success"><?= h($doctorInfo->name) ?></span>
                <?php if ($doctorInfo->department): ?>
                    <span class="status-badge badge-info"><?= h($doctorInfo->department->name) ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($currentUser) && !$currentUser->doctor_id): ?>
        <div class="alert alert-warning mb-4">
            <h5 class="alert-heading">Account Setup Required</h5>
            <p>Your doctor account is not fully set up. Please contact the hospital administration.</p>
        </div>
    <?php else: ?>

    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= isset($todaysCount) ? $todaysCount : 0 ?></h4>
                    <p>Today's Appointments</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-details">
                    <h4>
                        <?php
                        $completedToday = 0;
                        if (isset($todaysAppointments) && is_array($todaysAppointments)) {
                            foreach ($todaysAppointments as $appt) {
                                if ($appt->status === 'Completed') $completedToday++;
                            }
                        }
                        echo $completedToday;
                        ?>
                    </h4>
                    <p>Completed Today</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-content">
                <div class="stat-details">
                    <h4>
                        <?php
                        $pendingToday = 0;
                        if (isset($todaysAppointments) && is_array($todaysAppointments)) {
                            foreach ($todaysAppointments as $appt) {
                                if (in_array($appt->status, ['Scheduled', 'Pending', 'Confirmed', 'In Progress'])) $pendingToday++;
                            }
                        }
                        echo $pendingToday;
                        ?>
                    </h4>
                    <p>Pending Today</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= isset($upcomingAppointments) ? count($upcomingAppointments) : 0 ?></h4>
                    <p>Upcoming This Week</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-week"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="content-grid">
        <div class="glass-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-day"></i>
                    Today's Schedule - <?= date('M d') ?>
                </h5>
            </div>
            <div class="card-body">
                <?php if (isset($todaysAppointments) && !empty($todaysAppointments)): ?>
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todaysAppointments as $appointment): ?>
                                    <tr>
                                        <td class="time-cell">
                                            <?= $appointment->appointment_time->format('g:i A') ?>
                                        </td>
                                        <td>
                                            <strong><?= h($appointment->patient->name) ?></strong>
                                        </td>
                                        <td>
                                            <?php
                                                $badgeClass = 'badge-scheduled';
                                                switch($appointment->status) {
                                                    case 'Confirmed': $badgeClass = 'badge-info'; break;
                                                    case 'In Progress': $badgeClass = 'badge-warning'; break;
                                                    case 'Completed': $badgeClass = 'badge-success'; break;
                                                    case 'Cancelled': $badgeClass = 'badge-danger'; break;
                                                }
                                            ?>
                                            <span class="status-badge <?= $badgeClass ?>"><?= h($appointment->status) ?></span>
                                        </td>
                                        <td>
                                            <?= $this->Html->link(
                                                '<i class="fas fa-eye"></i>', 
                                                ['controller' => 'Appointments', 'action' => 'view', $appointment->id], 
                                                ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']
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
                        <p>No appointments scheduled for today.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div>
            <div class="glass-card">
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
                                <div class="list-group-item mb-2 p-3 border rounded bg-light">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="m-0 fw-bold"><?= h($appointment->patient->name) ?></h6>
                                        <small class="text-muted"><?= $appointment->appointment_date->format('M d') ?></small>
                                    </div>
                                    <p class="m-0 text-muted small">
                                        <i class="fas fa-clock me-1"></i> 
                                        <?= $appointment->appointment_time->format('g:i A') ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center mt-3">
                            <?= $this->Html->link(
                                'View All', 
                                ['controller' => 'Appointments', 'action' => 'index'], 
                                ['class' => 'btn btn-sm btn-outline-primary']
                            ) ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <p>No upcoming appointments this week.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($doctorInfo) && $doctorInfo): ?>
            <div class="glass-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-user-md"></i>
                        My Profile
                    </h5>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> Dr. <?= h($doctorInfo->name) ?></p>
                    <?php if ($doctorInfo->department): ?>
                    <p><strong>Department:</strong> <?= h($doctorInfo->department->name) ?></p>
                    <?php endif; ?>
                    <p><strong>Email:</strong> <?= h($currentUser->email ?? 'N/A') ?></p>
                    
                    <div class="text-center mt-3">
                        <?= $this->Html->link(
                            'Edit Profile', 
                            ['action' => 'edit', $doctorInfo->id], 
                            ['class' => 'btn btn-sm btn-outline-primary']
                        ) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="glass-card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-bolt"></i>
                Quick Actions
            </h5>
        </div>
        <div class="card-body">
            <div class="d-flex gap-3 flex-wrap">
                <?= $this->Html->link(
                    '<i class="fas fa-list"></i> All Appointments', 
                    ['controller' => 'Appointments', 'action' => 'index'], 
                    ['class' => 'btn btn-primary', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-users"></i> My Patients', 
                    ['controller' => 'Patients', 'action' => 'index'], 
                    ['class' => 'btn btn-outline-primary', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-clock"></i> My Schedule', 
                    ['controller' => 'DoctorSchedules', 'action' => 'index'], 
                    ['class' => 'btn btn-outline-primary', 'escape' => false]
                ) ?>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div>