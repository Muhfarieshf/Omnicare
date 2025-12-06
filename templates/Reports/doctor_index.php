<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="dashboard-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-chart-bar"></i>
            Reports & Analytics
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="form-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded p-3 bg-primary bg-opacity-10 text-primary me-3">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Monthly Appointments</h5>
                            <p class="text-muted small mb-0">Generate a summary of appointments by month.</p>
                        </div>
                    </div>

                    <?= $this->Form->create(null, ['url' => ['action' => 'monthlyReport'], 'type' => 'get']) ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Month</label>
                            <input type="month" name="month" class="form-control" value="<?= date('Y-m') ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-alt me-2"></i> Generate Report
                            </button>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="form-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded p-3 bg-success bg-opacity-10 text-success me-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">Daily Schedule</h5>
                            <p class="text-muted small mb-0">Printable daily schedule for doctors.</p>
                        </div>
                    </div>

                    <?= $this->Form->create(null, ['url' => ['action' => 'printDailySchedule'], 'type' => 'get', 'target' => '_blank']) ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Date</label>
                            <input type="date" name="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-print me-2"></i> Print Schedule
                            </button>
                        </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>