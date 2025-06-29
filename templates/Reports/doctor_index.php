<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.reports-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0 32px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
}

/* Doctor Info Alert */
.doctor-info-alert {
    background: rgba(0, 102, 204, 0.1);
    border: 1px solid rgba(0, 102, 204, 0.2);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 32px;
    border-left: 4px solid #0066cc;
}

.doctor-info-alert h5 {
    color: #0066cc;
    font-weight: 600;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.doctor-info-alert p {
    color: #004499;
    margin: 0;
    font-size: 14px;
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
    text-align: center;
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

.stat-card.info {
    --gradient: linear-gradient(135deg, #06b6d4, #0891b2);
}

.stat-card.warning {
    --gradient: linear-gradient(135deg, #f59e0b, #d97706);
}

.stat-value {
    font-size: 36px;
    font-weight: 700;
    color: #1f1f1f;
    margin-bottom: 8px;
}

.stat-label {
    color: #666;
    font-size: 14px;
    font-weight: 500;
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

/* Report Action Cards */
.report-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.report-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.report-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.report-card-header {
    padding: 16px 20px;
    color: white;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.report-card-header.primary {
    background: linear-gradient(135deg, #0066cc, #004499);
}

.report-card-header.success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.report-card-header.info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.report-card-body {
    padding: 20px;
}

.report-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
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

.btn-sm {
    padding: 8px 12px;
    font-size: 13px;
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
}

.btn-outline-primary {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.btn-outline-primary:hover {
    background: #0066cc;
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
}

.btn-outline-success {
    background: transparent;
    color: #22c55e;
    border: 1px solid #22c55e;
}

.btn-outline-success:hover {
    background: #22c55e;
    color: white;
}

.btn-info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
}

.btn-info:hover {
    background: linear-gradient(135deg, #0891b2, #0e7490);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
}

.btn-outline-info {
    background: transparent;
    color: #06b6d4;
    border: 1px solid #06b6d4;
}

.btn-outline-info:hover {
    background: #06b6d4;
    color: white;
}

/* Performance Section */
.performance-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.performance-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.performance-stat h4 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 4px;
}

.performance-stat p {
    color: #666;
    font-size: 14px;
    margin-bottom: 8px;
}

.progress-bar-container {
    background: rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    height: 8px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    border-radius: 6px;
    transition: width 0.3s ease;
}

.progress-bar.success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.progress-bar.warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.progress-bar.danger {
    background: linear-gradient(135deg, #e11d48, #be185d);
}

/* Table */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.table th {
    font-weight: 600;
    color: #666;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(248, 249, 250, 0.5);
}

.table tbody tr:hover {
    background: rgba(0, 102, 204, 0.02);
}

/* Badges */
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

.badge.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.badge.primary {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.badge.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.badge.danger {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

/* Tips Section */
.tips-card {
    border: 1px solid rgba(108, 117, 125, 0.2);
    background: rgba(248, 249, 250, 0.5);
}

.tips-card .card-header {
    background: rgba(248, 249, 250, 0.8);
    color: #666;
}

.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.tip-item h6 {
    color: #1f1f1f;
    font-weight: 600;
    margin-bottom: 8px;
}

.tip-item p {
    color: #666;
    font-size: 13px;
    line-height: 1.4;
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .reports-container {
        padding: 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .performance-grid {
        grid-template-columns: 1fr;
    }
    
    .performance-stats {
        grid-template-columns: 1fr;
    }
    
    .report-cards-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="reports-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-chart-bar"></i>
            My Reports
        </h1>
    </div>

    <!-- Doctor Info -->
    <div class="doctor-info-alert">
        <h5><i class="fas fa-user-md"></i> <?= h($doctor->name) ?></h5>
        <p>Department: <?= h($doctor->department->name ?? 'Unknown') ?> | Generated: <?= date('M d, Y H:i A') ?></p>
    </div>

    <!-- Quick Statistics -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-value"><?= $reportData['todayCount'] ?></div>
            <div class="stat-label">Today's Appointments</div>
        </div>
        <div class="stat-card success">
            <div class="stat-value"><?= $reportData['weekCount'] ?></div>
            <div class="stat-label">This Week</div>
        </div>
        <div class="stat-card info">
            <div class="stat-value"><?= $reportData['monthCount'] ?></div>
            <div class="stat-label">This Month</div>
        </div>
        <div class="stat-card warning">
            <div class="stat-value"><?= $reportData['totalPatients'] ?></div>
            <div class="stat-label">Total Patients</div>
        </div>
    </div>

    <!-- Report Actions -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-download"></i>
                Generate Reports
            </h5>
        </div>
        <div class="card-body">
            <div class="report-cards-grid">
                <!-- Daily Reports -->
                <div class="report-card">
                    <div class="report-card-header primary">
                        <i class="fas fa-calendar-day"></i>
                        <span>Daily Reports</span>
                    </div>
                    <div class="report-card-body">
                        <div class="report-buttons">
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

                <!-- Patient Reports -->
                <div class="report-card">
                    <div class="report-card-header success">
                        <i class="fas fa-users"></i>
                        <span>Patient Reports</span>
                    </div>
                    <div class="report-card-body">
                        <div class="report-buttons">
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

                <!-- Monthly Reports -->
                <div class="report-card">
                    <div class="report-card-header info">
                        <i class="fas fa-chart-line"></i>
                        <span>Monthly Analytics</span>
                    </div>
                    <div class="report-card-body">
                        <div class="report-buttons">
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

    <!-- Performance and Recent Appointments -->
    <div class="performance-grid">
        <!-- This Month's Performance -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-chart-pie"></i>
                    This Month's Performance
                </h5>
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
                
                <div class="performance-stats">
                    <div class="performance-stat">
                        <h4 style="color: #22c55e;"><?= $completed ?></h4>
                        <p>Completed<br><small>(<?= $completedPct ?>%)</small></p>
                        <div class="progress-bar-container">
                            <div class="progress-bar success" style="width: <?= $completedPct ?>%"></div>
                        </div>
                    </div>
                    <div class="performance-stat">
                        <h4 style="color: #f59e0b;"><?= $noShow ?></h4>
                        <p>No Show<br><small>(<?= $noShowPct ?>%)</small></p>
                        <div class="progress-bar-container">
                            <div class="progress-bar warning" style="width: <?= $noShowPct ?>%"></div>
                        </div>
                    </div>
                    <div class="performance-stat">
                        <h4 style="color: #e11d48;"><?= $cancelled ?></h4>
                        <p>Cancelled<br><small>(<?= $cancelledPct ?>%)</small></p>
                        <div class="progress-bar-container">
                            <div class="progress-bar danger" style="width: <?= $cancelledPct ?>%"></div>
                        </div>
                    </div>
                </div>
                
                <?php if ($total > 0): ?>
                    <hr style="border: none; height: 1px; background: rgba(0,0,0,0.05); margin: 20px 0;">
                    <p style="text-align: center; color: #666;">
                        <strong>Overall Completion Rate: <?= $completedPct ?>%</strong>
                        <?php if ($completedPct >= 90): ?>
                            <span class="badge success" style="margin-left: 8px;">Excellent!</span>
                        <?php elseif ($completedPct >= 80): ?>
                            <span class="badge primary" style="margin-left: 8px;">Good</span>
                        <?php elseif ($completedPct >= 70): ?>
                            <span class="badge warning" style="margin-left: 8px;">Fair</span>
                        <?php else: ?>
                            <span class="badge danger" style="margin-left: 8px;">Needs Improvement</span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-history"></i>
                    Recent Appointments
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($reportData['recentAppointments'])): ?>
                    <p style="color: #666; text-align: center;">No recent appointments found.</p>
                <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table class="table">
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
                                        <span class="badge <?= $appointment->status === 'Completed' ? 'success' : ($appointment->status === 'Cancelled' ? 'danger' : ($appointment->status === 'No Show' ? 'warning' : 'primary')) ?>">
                                            <?= h($appointment->status) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align: center;">
                        <?= $this->Html->link('View All Appointments', ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Tips -->
    <div class="card tips-card">
        <div class="card-header">
            <h6 style="margin: 0; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-lightbulb"></i>
                Quick Tips
            </h6>
        </div>
        <div class="card-body">
            <div class="tips-grid">
                <div class="tip-item">
                    <h6>📊 Performance Tracking</h6>
                    <p>Monitor your completion rates to identify patterns and improve efficiency.</p>
                </div>
                <div class="tip-item">
                    <h6>📅 Schedule Management</h6>
                    <p>Print daily schedules to stay organized and prepare for patient visits.</p>
                </div>
                <div class="tip-item">
                    <h6>👥 Patient Care</h6>
                    <p>Export patient lists to maintain updated contact information and follow-ups.</p>
                </div>
            </div>
        </div>
    </div>
</div>