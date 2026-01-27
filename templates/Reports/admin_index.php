<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="dashboard-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-chart-line"></i>
            Clinic Analytics
        </h3>
    </div>

    <!-- Key Metrics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Patients -->
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-white-50">Total Patients</h6>
                            <h2 class="card-title mb-0 display-6 fw-bold">
                                <?= number_format($totalPatients) ?>
                            </h2>
                        </div>
                        <i class="fas fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Doctors -->
        <div class="col-md-3">
            <div class="card bg-success text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-white-50">Active Doctors</h6>
                            <h2 class="card-title mb-0 display-6 fw-bold">
                                <?= number_format($activeDoctors) ?>
                            </h2>
                        </div>
                        <i class="fas fa-user-md fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Appointments -->
        <div class="col-md-3">
            <div class="card bg-info text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-white-50">Total Appointments</h6>
                            <h2 class="card-title mb-0 display-6 fw-bold">
                                <?= number_format($totalAppointments) ?>
                            </h2>
                        </div>
                        <i class="fas fa-calendar-check fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Departments -->
        <div class="col-md-3">
            <div class="card bg-warning text-white h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-white-50">Departments</h6>
                            <h2 class="card-title mb-0 display-6 fw-bold">
                                <?= number_format($totalDepartments) ?>
                            </h2>
                        </div>
                        <i class="fas fa-building fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold text-primary"><i class="fas fa-calendar-alt me-2"></i>Recent Appointments</h5>
                </div>
                <div class="card-body p-0 table-responsive">
                     <table class="table table-hover mb-0">
                         <thead class="bg-light">
                             <tr>
                                 <th class="ps-4">Patient</th>
                                 <th>Doctor</th>
                                 <th>Date</th>
                                 <th>Status</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php foreach ($recentAppointments as $appt): ?>
                             <tr>
                                 <td class="ps-4 fw-bold text-dark"><?= h($appt->patient->name ?? 'Unknown') ?></td>
                                 <td>Dr. <?= h($appt->doctor->name ?? 'Unknown') ?></td>
                                 <td><?= h($appt->appointment_date->format('M d')) ?></td>
                                 <td><span class="badge bg-secondary"><?= h($appt->status) ?></span></td>
                             </tr>
                             <?php endforeach; ?>
                             <?php if (empty($recentAppointments)): ?>
                                <tr><td colspan="4" class="text-center py-4 text-muted">No appointments found.</td></tr>
                             <?php endif; ?>
                         </tbody>
                     </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 position-relative">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold text-success"><i class="fas fa-chart-pie me-2"></i>Performance
                        Overview</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center text-muted"
                    style="min-height: 250px;">
                    <div class="text-center">
                        <i class="fas fa-chart-area fa-3x mb-3 text-secondary opacity-50"></i>
                        <p>Detailed analytics charts coming soon.</p>
                        <button class="btn btn-sm btn-outline-primary mt-2">Download Summary CSV</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>