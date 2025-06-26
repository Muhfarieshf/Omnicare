<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Patient Dashboard</h1>
    <?php if (isset($patientInfo) && $patientInfo): ?>
        <div class="btn-toolbar mb-2 mb-md-0">
            <span class="badge bg-info fs-6">Welcome, <?= h($patientInfo->name) ?></span>
        </div>
    <?php elseif (isset($currentUser)): ?>
        <div class="btn-toolbar mb-2 mb-md-0">
            <span class="badge bg-secondary fs-6">Welcome, <?= h($currentUser->username) ?></span>
        </div>
    <?php endif; ?>
</div>

<?php if (isset($currentUser) && !$currentUser->patient_id): ?>
    <div class="alert alert-warning">
        <h5>Account Setup Required</h5>
        <p>Your patient account is not fully set up. Please contact the hospital administration to complete your profile.</p>
        <p><strong>Username:</strong> <?= h($currentUser->username) ?></p>
        <p><strong>Role:</strong> <?= h($currentUser->role) ?></p>
    </div>
<?php else: ?>

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
                        <p>No upcoming appointments.</p>
                        <?= $this->Html->link('Schedule New Appointment', ['controller' => 'Appointments', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
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
                    <div class="list-group">
                        <?php foreach ($myAppointments as $appointment): ?>
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
                                <?php if (!empty($appointment->remarks)): ?>
                                <p class="mb-1"><i class="fas fa-sticky-note"></i> <?= h($appointment->remarks) ?></p>
                                <?php endif; ?>
                                <small>Status: <span class="badge bg-secondary"><?= h($appointment->status) ?></span></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <p>No appointment history.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
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
                            '<i class="fas fa-plus"></i> Schedule Appointment', 
                            ['controller' => 'Appointments', 'action' => 'add'], 
                            ['class' => 'btn btn-primary w-100', 'escape' => false]
                        ) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-list"></i> View All Appointments', 
                            ['controller' => 'Appointments', 'action' => 'index'], 
                            ['class' => 'btn btn-outline-primary w-100', 'escape' => false]
                        ) ?>
                    </div>
                    <?php if (isset($currentUser) && $currentUser->patient_id): ?>
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-user"></i> My Profile', 
                            ['action' => 'view', $currentUser->patient_id], 
                            ['class' => 'btn btn-outline-secondary w-100', 'escape' => false]
                        ) ?>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <?= $this->Html->link(
                            '<i class="fas fa-user-md"></i> Find Doctors', 
                            ['controller' => 'Doctors', 'action' => 'index'], 
                            ['class' => 'btn btn-outline-info w-100', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>