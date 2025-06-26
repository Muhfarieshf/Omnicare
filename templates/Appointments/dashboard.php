<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4><?= $totalPatients ?></h4>
                        <p class="card-text">Total Patients</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4><?= $totalDoctors ?></h4>
                        <p class="card-text">Total Doctors</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-md fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4><?= $todaysCount ?></h4>
                        <p class="card-text">Today's Appointments</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-day fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4><?= $totalAppointments ?></h4>
                        <p class="card-text">Total Appointments</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Today's Appointments -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Today's Appointments</h5>
            </div>
            <div class="card-body">
                <?php if (empty($todaysAppointments)): ?>
                    <p class="text-muted">No appointments scheduled for today.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todaysAppointments as $appointment): ?>
                                <tr>
                                    <td><?= h($appointment->appointment_time->format('H:i')) ?></td>
                                    <td><?= h($appointment->patient->name) ?></td>
                                    <td><?= h($appointment->doctor->name) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Cancelled' ? 'danger' : 'primary') ?>">
                                            <?= h($appointment->status) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Upcoming Appointments (Next 7 Days)</h5>
            </div>
            <div class="card-body">
                <?php if (empty($upcomingAppointments)): ?>
                    <p class="text-muted">No upcoming appointments.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($upcomingAppointments as $appointment): ?>
                                <tr>
                                    <td><?= h($appointment->appointment_date->format('M d')) ?></td>
                                    <td><?= h($appointment->appointment_time->format('H:i')) ?></td>
                                    <td><?= h($appointment->patient->name) ?></td>
                                    <td><?= h($appointment->doctor->name) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>