<?php
// Block access for non-doctors (including admins and patients)
if (!isset($currentUser) || $currentUser->role !== 'doctor') {
    echo '<div class="alert alert-danger mt-4"><h4>Access Denied</h4><p>You do not have permission to view this page.</p></div>';
    return;
}
?>
<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-0 text-left">Doctor Dashboard</h1>
                <?php if (isset($doctorInfo) && $doctorInfo): ?>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <span class="badge bg-success fs-6"><?= h($doctorInfo->name) ?></span>
                        <?php if ($doctorInfo->department): ?>
                            <span class="badge bg-info fs-6 ms-2"><?= h($doctorInfo->department->name) ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

<?php if (isset($currentUser) && !$currentUser->doctor_id): ?>
    <div class="alert alert-warning">
        <h5>Account Setup Required</h5>
        <p>Your doctor account is not fully set up. Please contact the hospital administration to complete your profile.</p>
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
                        <h4><?= isset($todaysCount) ? $todaysCount : 0 ?></h4>
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
                <h5><i class="fas fa-calendar-day"></i> Today's Schedule - <?= date('M d, Y') ?></h5>
            </div>
            <div class="card-body">
                <?php if (isset($todaysAppointments) && !empty($todaysAppointments)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                            <div>
                                                <strong><?= h($appointment->patient->name) ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <?= !empty($appointment->remarks) ? h($appointment->remarks) : '<em class="text-muted">No remarks</em>' ?>
                                        </td>
                                        <td>
                                            <?php
                                                $statusClass = 'secondary';
                                                switch($appointment->status) {
                                                    case 'Scheduled': $statusClass = 'primary'; break;
                                                    case 'Completed': $statusClass = 'success'; break;
                                                    case 'Cancelled': $statusClass = 'danger'; break;
                                                    case 'No Show': $statusClass = 'warning'; break;
                                                }
                                            ?>
                                            <span class="badge bg-<?= $statusClass ?>"><?= h($appointment->status) ?></span>
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
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5>No appointments scheduled for today</h5>
                        <p class="text-muted">Enjoy your free day!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-calendar-week"></i> Upcoming Appointments</h5>
            </div>
            <div class="card-body">
                <?php if (isset($upcomingAppointments) && !empty($upcomingAppointments)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($upcomingAppointments as $appointment): ?>
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?= h($appointment->patient->name) ?></h6>
                                    <small><?= $appointment->appointment_date->format('M d') ?></small>
                                </div>
                                <p class="mb-1">
                                    <i class="fas fa-clock"></i> <?= $appointment->appointment_time->format('g:i A') ?>
                                </p>
                                <small class="text-muted"><?= h($appointment->remarks ?: 'No remarks') ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center mt-3">
                        <?= $this->Html->link(
                            'View All Appointments', 
                            ['controller' => 'Appointments', 'action' => 'index'], 
                            ['class' => 'btn btn-outline-primary btn-sm']
                        ) ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-check fa-2x text-muted mb-3"></i>
                        <p>No upcoming appointments this week.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Doctor Info Card -->
        <?php if (isset($doctorInfo) && $doctorInfo): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h5><i class="fas fa-user-md"></i> My Profile</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> Dr. <?= h($doctorInfo->name) ?></p>
                <?php if ($doctorInfo->department): ?>
                <p><strong>Department:</strong> <?= h($doctorInfo->department->name) ?></p>
                <?php endif; ?>
                <p><strong>Email:</strong> <?= h($currentUser->email ?? 'N/A') ?></p>
                <div class="text-center">
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
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-tachometer-alt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-list"></i> All Appointments', 
                            ['controller' => 'Appointments', 'action' => 'index'], 
                            ['class' => 'btn btn-primary w-100', 'escape' => false]
                        ) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-users"></i> Patients', 
                            ['controller' => 'Patients', 'action' => 'index'], 
                            ['class' => 'btn btn-outline-primary w-100', 'escape' => false]
                        ) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-calendar-plus"></i> Schedule', 
                            ['controller' => 'Appointments', 'action' => 'add'], 
                            ['class' => 'btn btn-outline-success w-100', 'escape' => false]
                        ) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-chart-bar"></i> Reports', 
                            ['controller' => 'Reports', 'action' => 'index'], 
                            ['class' => 'btn btn-outline-info w-100', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>