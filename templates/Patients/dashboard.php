<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-0 text-left">Patient Dashboard</h1>
            </div>

<?php if (isset($currentUser) && !$currentUser->patient_id): ?>
    <div class="alert alert-warning">
        <h5>Account Setup Required</h5>
        <p>Your patient account is not fully set up. Please contact the hospital administration to complete your profile.</p>
        <p><strong>Username:</strong> <?= h($currentUser->username) ?></p>
        <p><strong>Role:</strong> <?= h($currentUser->role) ?></p>
    </div>
<?php else: ?>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4><?= isset($todaysAppointments) ? count($todaysAppointments) : 0 ?></h4>
                        <p class="mb-0">Today's Appointments</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-day fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
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
                        <p class="mb-0">Completed Today</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>
                            <?php
                            $pendingToday = 0;
                            if (isset($todaysAppointments) && is_array($todaysAppointments)) {
                                foreach ($todaysAppointments as $appt) {
                                    if ($appt->status === 'Scheduled' || $appt->status === 'Pending') $pendingToday++;
                                }
                            }
                            echo $pendingToday;
                            ?>
                        </h4>
                        <p class="mb-0">Pending Today</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4><?= isset($upcomingAppointments) ? count($upcomingAppointments) : 0 ?></h4>
                        <p class="mb-0">Upcoming This Week</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-week fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-calendar-plus"></i> My Upcoming Appointments</h5>
            </div>
            <div class="card-body">
                <?php if (isset($upcomingAppointments) && !empty($upcomingAppointments)): ?>
                    <div class="list-group">
                        <?php foreach ($upcomingAppointments as $appointment): ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-user-md"></i> 
                                        Dr. <?= h($appointment->doctor->name) ?>
                                    </h6>
                                    <small><?= $appointment->appointment_date->format('M d, Y') ?></small>
                                </div>
                                <p class="mb-1">
                                    <i class="fas fa-clock"></i> Time: <?= $appointment->appointment_time->format('g:i A') ?>
                                </p>
                                <?php if (isset($appointment->doctor->department) && $appointment->doctor->department): ?>
                                <p class="mb-1">
                                    <i class="fas fa-building"></i> Department: <?= h($appointment->doctor->department->name) ?>
                                </p>
                                <?php endif; ?>
                                <small>Status: <span class="badge bg-primary"><?= h($appointment->status) ?></span></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5>No upcoming appointments.</h5>
                        <?= $this->Html->link('Schedule New Appointment', 
                            ['controller' => 'Appointments', 'action' => 'add'], 
                            ['class' => 'btn btn-primary mt-2']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-history"></i> Recent Appointments</h5>
            </div>
            <div class="card-body">
                <?php if (isset($myAppointments) && !empty($myAppointments)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($myAppointments as $appointment): ?>
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        <i class="fas fa-user-md"></i> 
                                        Dr. <?= h($appointment->doctor->name) ?>
                                    </h6>
                                    <small><?= $appointment->appointment_date->format('M d, Y') ?></small>
                                </div>
                                <p class="mb-1">
                                    <i class="fas fa-clock"></i> Time: <?= $appointment->appointment_time->format('g:i A') ?>
                                </p>
                                <?php if (!empty($appointment->remarks)): ?>
                                <p class="mb-1"><i class="fas fa-sticky-note"></i> <?= h($appointment->remarks) ?></p>
                                <?php endif; ?>
                                <small>Status: <span class="badge bg-secondary"><?= h($appointment->status) ?></span></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-2x text-muted mb-3"></i>
                        <p>No appointment history.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5><i class="fas fa-user"></i> My Profile</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($patientInfo) && !empty($patientInfo->name)): ?>
                <p><strong>Name:</strong> <?= h($patientInfo->name) ?></p>
                 <?php endif; ?>
                <p><strong>Email:</strong> <?= h($currentUser->email ?? 'N/A') ?></p>
                <div class="text-center">
                     <?= $this->Html->link(
                        'Edit Profile', 
                        ['controller' => 'Patients', 'action' => 'edit', $patientInfo->id], 
                        ['class' => 'btn btn-outline-primary btn-sm']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4 justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-tachometer-alt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 justify-content-center">
                    <div class="col-12 col-md-3">
                        <div class="d-grid gap-2">
                            <?= $this->Html->link(
                                '<i class="fas fa-plus"></i> Schedule Appointment',
                                ['controller' => 'Appointments', 'action' => 'add'],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-lg btn-primary quick-action-btn mb-2'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-grid gap-2">
                            <?= $this->Html->link(
                                '<i class="fas fa-list"></i> View All Appointments',
                                ['controller' => 'Appointments', 'action' => 'index'],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-lg btn-outline-primary quick-action-btn mb-2'
                                ]
                            ) ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-grid gap-2">
                            <?= $this->Html->link(
                                '<i class="fas fa-user-md"></i> Find Doctors',
                                ['controller' => 'Doctors', 'action' => 'index'],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-lg btn-outline-info quick-action-btn mb-2'
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>