<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 mb-0 text-left"><i class="fas fa-chart-bar"></i> My Reports</h1>
                <div>
                    <?= $this->Html->link('Back to Dashboard', ['controller' => 'Doctors', 'action' => 'dashboard'], ['class' => 'btn btn-secondary']) ?>
                </div>
            </div>

<!-- Doctor Info -->
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-info">
            <h5><i class="fas fa-user-md"></i> <?= h($doctor->name) ?></h5>
            <p class="mb-0">Department: <?= h($doctor->department->name ?? 'Unknown') ?> | Generated: <?= date('M d, Y H:i A') ?></p>
        </div>
    </div>
</div>

<!-- Quick Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <h3><?= $reportData['todayCount'] ?></h3>
                <p>Today's Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <h3><?= $reportData['weekCount'] ?></h3>
                <p>This Week</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <h3><?= $reportData['monthCount'] ?></h3>
                <p>This Month</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h3><?= $reportData['totalPatients'] ?></h3>
                <p>Total Patients</p>
            </div>
        </div>
    </div>
</div>

<!-- Report Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-download"></i> Generate Reports</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Daily Reports -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h6><i class="fas fa-calendar-day"></i> Daily Reports</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <?= $this->Html->link(
                                        '<i class="fas fa-print"></i> Print Today\'s Schedule', 
                                        ['action' => 'printDailySchedule', date('Y-m-d')], 
                                        ['class' => 'btn btn-primary btn-sm', 'escape' => false, 'target' => '_blank']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-print"></i> Print Yesterday\'s Schedule', 
                                        ['action' => 'printDailySchedule', date('Y-m-d', strtotime('-1 day'))], 
                                        ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false, 'target' => '_blank']
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-print"></i> Print Tomorrow\'s Schedule', 
                                        ['action' => 'printDailySchedule', date('Y-m-d', strtotime('+1 day'))], 
                                        ['class' => 'btn btn-outline-primary btn-sm', 'escape' => false, 'target' => '_blank']
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Reports -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">
                                <h6><i class="fas fa-users"></i> Patient Reports</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <?= $this->Html->link(
                                        '<i class="fas fa-file-excel"></i> Export My Patients', 
                                        ['action' => 'exportPatients'], 
                                        ['class' => 'btn btn-success btn-sm', 'escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-list"></i> View All Patients', 
                                        ['controller' => 'Patients', 'action' => 'index'], 
                                        ['class' => 'btn btn-outline-success btn-sm', 'escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-search"></i> Search Patients', 
                                        ['controller' => 'Patients', 'action' => 'index'], 
                                        ['class' => 'btn btn-outline-success btn-sm', 'escape' => false]
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Reports -->
                    <div class="col-md-4 mb-3">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">
                                <h6><i class="fas fa-chart-line"></i> Monthly Analytics</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <?= $this->Html->link(
                                        '<i class="fas fa-chart-bar"></i> This Month\'s Report', 
                                        ['action' => 'monthlyReport'], 
                                        ['class' => 'btn btn-info btn-sm', 'escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-chart-bar"></i> Last Month\'s Report', 
                                        ['action' => 'monthlyReport', '?' => ['month' => date('Y-m', strtotime('-1 month'))]], 
                                        ['class' => 'btn btn-outline-info btn-sm', 'escape' => false]
                                    ) ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-calendar"></i> Custom Date Range', 
                                        ['action' => 'monthlyReport'], 
                                        ['class' => 'btn btn-outline-info btn-sm', 'escape' => false]
                                    ) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- This Month's Performance -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-pie"></i> This Month's Performance</h5>
            </div>
            <div class="card-body">
                <?php
                $total = $reportData['monthCount'];
                $completed = $reportData['completedMonth'];
                $noShow = $reportData['noShowMonth'];
                $cancelled = $reportData['cancelledMonth'];
                
                $completedPct = $total > 0 ? round(($completed / $total) * 100, 1) : 0;
                $noShowPct = $total > 0 ? round(($noShow / $total) * 100, 1) : 0;
                $cancelledPct = $total > 0 ? round(($cancelled / $total) * 100, 1) : 0;
                ?>
                
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4 class="text-success"><?= $completed ?></h4>
                        <p>Completed<br><small>(<?= $completedPct ?>%)</small></p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" style="width: <?= $completedPct ?>%"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-warning"><?= $noShow ?></h4>
                        <p>No Show<br><small>(<?= $noShowPct ?>%)</small></p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" style="width: <?= $noShowPct ?>%"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-danger"><?= $cancelled ?></h4>
                        <p>Cancelled<br><small>(<?= $cancelledPct ?>%)</small></p>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-danger" style="width: <?= $cancelledPct ?>%"></div>
                        </div>
                    </div>
                </div>
                
                <?php if ($total > 0): ?>
                    <hr>
                    <p class="text-center text-muted">
                        <strong>Overall Completion Rate: <?= $completedPct ?>%</strong>
                        <?php if ($completedPct >= 90): ?>
                            <span class="badge bg-success ms-2">Excellent!</span>
                        <?php elseif ($completedPct >= 80): ?>
                            <span class="badge bg-primary ms-2">Good</span>
                        <?php elseif ($completedPct >= 70): ?>
                            <span class="badge bg-warning ms-2">Fair</span>
                        <?php else: ?>
                            <span class="badge bg-danger ms-2">Needs Improvement</span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-history"></i> Recent Appointments</h5>
            </div>
            <div class="card-body">
                <?php if (empty($reportData['recentAppointments'])): ?>
                    <p class="text-muted text-center">No recent appointments found.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Patient</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($reportData['recentAppointments'], 0, 8) as $appointment): ?>
                                <tr>
                                    <td><?= h($appointment->appointment_date->format('M d')) ?></td>
                                    <td><?= h($appointment->patient->name ?? 'Unknown') ?></td>
                                    <td>
                                        <span class="badge bg-<?= $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Cancelled' ? 'danger' : ($appointment->status === 'No Show' ? 'warning' : 'primary')) ?>">
                                            <?= h($appointment->status) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <?= $this->Html->link('View All Appointments', ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Quick Tips -->
<div class="row">
    <div class="col-12">
        <div class="card border-secondary">
            <div class="card-header bg-light">
                <h6><i class="fas fa-lightbulb"></i> Quick Tips</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>📊 Performance Tracking</h6>
                        <p class="small text-muted">Monitor your completion rates to identify patterns and improve efficiency.</p>
                    </div>
                    <div class="col-md-4">
                        <h6>📅 Schedule Management</h6>
                        <p class="small text-muted">Print daily schedules to stay organized and prepare for patient visits.</p>
                    </div>
                    <div class="col-md-4">
                        <h6>👥 Patient Care</h6>
                        <p class="small text-muted">Export patient lists to maintain updated contact information and follow-ups.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>