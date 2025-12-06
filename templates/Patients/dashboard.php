<?php
if (!isset($currentUser) || $currentUser->role !== 'patient') {
    echo '<div class="alert alert-danger m-4"><h4>Access Denied</h4></div>';
    return;
}
?>

<div class="dashboard-container">
    <div class="dashboard-header mb-4">
        <h1 class="dashboard-title">
            <i class="fas fa-user"></i> Patient Dashboard
        </h1>
    </div>

    <?php if (isset($currentUser) && !$currentUser->patient_id): ?>
        <div class="alert alert-warning">
            <h5>Account Setup Required</h5>
            <p>Please contact reception to link your patient profile.</p>
        </div>
    <?php else: ?>

    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= isset($todaysAppointments) ? count($todaysAppointments) : 0 ?></h4>
                    <p>Today</p>
                </div>
                <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= isset($upcomingAppointments) ? count($upcomingAppointments) : 0 ?></h4>
                    <p>Upcoming</p>
                </div>
                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
            </div>
        </div>
    </div>

    <div class="content-grid">
        <div class="glass-card">
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
                            <div class="list-group-item mb-2 p-3 border rounded bg-light">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="m-0 fw-bold">
                                        Dr. <?= h($appointment->doctor->name) ?>
                                    </h6>
                                    <small class="text-muted"><?= $appointment->appointment_date->format('M d, Y') ?></small>
                                </div>
                                <p class="m-0 text-muted small">
                                    <i class="fas fa-clock me-1"></i> 
                                    <?= $appointment->appointment_time->format('g:i A') ?>
                                </p>
                                <span class="status-badge badge-scheduled mt-2"><?= h($appointment->status) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <p>No upcoming appointments.</p>
                        <?= $this->Html->link(
                            '<i class="fas fa-plus"></i> Book Now', 
                            ['controller' => 'Appointments', 'action' => 'add'], 
                            ['class' => 'btn btn-primary mt-2', 'escape' => false]
                        ) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <div class="glass-card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-user"></i> My Profile</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($patientInfo)): ?>
                        <p><strong>Name:</strong> <?= h($patientInfo->name) ?></p>
                        <p><strong>Email:</strong> <?= h($currentUser->email ?? 'N/A') ?></p>
                    <?php endif; ?>
                    <div class="text-center mt-3">
                        <?= $this->Html->link(
                            'Edit Profile', 
                            ['controller' => 'Patients', 'action' => 'edit', $patientInfo->id], 
                            ['class' => 'btn btn-sm btn-outline-primary']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card">
        <div class="card-header">
            <h5 class="card-title"><i class="fas fa-bolt"></i> Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="d-flex gap-3 flex-wrap">
                <?= $this->Html->link(
                    '<i class="fas fa-plus"></i> Book Appointment',
                    ['controller' => 'Appointments', 'action' => 'add'],
                    ['escape' => false, 'class' => 'btn btn-primary']
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-list"></i> View History',
                    ['controller' => 'Appointments', 'action' => 'index'],
                    ['escape' => false, 'class' => 'btn btn-outline-primary']
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-user-md"></i> Find Doctors',
                    ['controller' => 'Doctors', 'action' => 'index'],
                    ['escape' => false, 'class' => 'btn btn-outline-primary']
                ) ?>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div>