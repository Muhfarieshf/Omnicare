<?php
/**
 * @var \App\View\AppView $this
 * @var object $doctor
 * @var string $month
 * @var array $reportData
 */
$monthName = date('F Y', strtotime($month . '-01'));
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.monthly-report-container {
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

.month-subtitle {
    font-size: 18px;
    font-weight: 500;
    color: #666;
    margin-top: 4px;
}

.header-actions {
    display: flex;
    gap: 12px;
    align-items: center;
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

/* Month Selector */
.month-selector-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 24px;
    margin-bottom: 32px;
    transition: all 0.3s ease;
}

.month-selector-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.month-selector-form {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

/* Summary Stats */
.summary-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
}

.summary-stat-card {
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

.summary-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.summary-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--gradient);
}

.summary-stat-card.primary {
    --gradient: linear-gradient(135deg, #0066cc, #004499);
}

.summary-stat-card.success {
    --gradient: linear-gradient(135deg, #22c55e, #16a34a);
}

.summary-stat-card.warning {
    --gradient: linear-gradient(135deg, #f59e0b, #d97706);
}

.summary-stat-card.danger {
    --gradient: linear-gradient(135deg, #e11d48, #be185d);
}

.stat-main-value {
    font-size: 36px;
    font-weight: 700;
    color: #1f1f1f;
    margin-bottom: 8px;
}

.stat-label {
    color: #666;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
}

.stat-percentage {
    font-size: 18px;
    font-weight: 600;
    margin-top: 8px;
}

.stat-percentage.positive {
    color: #22c55e;
}

.stat-percentage.neutral {
    color: #666;
}

.stat-percentage.negative {
    color: #e11d48;
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
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
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

/* Daily Stats Chart */
.daily-stats-grid {
    display: grid;
    gap: 12px;
}

.daily-stat-row {
    display: grid;
    grid-template-columns: 100px 80px 60px 1fr;
    gap: 16px;
    align-items: center;
    padding: 12px 16px;
    background: rgba(248, 249, 250, 0.5);
    border-radius: 8px;
    transition: all 0.2s ease;
}

.daily-stat-row:hover {
    background: rgba(0, 102, 204, 0.05);
    transform: translateX(4px);
}

.daily-date {
    font-weight: 600;
    color: #1f1f1f;
    font-size: 14px;
}

.daily-day {
    color: #666;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.daily-count {
    font-weight: 700;
    color: #0066cc;
    font-size: 16px;
    text-align: center;
}

.daily-progress {
    position: relative;
}

.progress-bar-container {
    background: rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    height: 8px;
    overflow: hidden;
    position: relative;
}

.progress-bar {
    height: 100%;
    border-radius: 6px;
    background: linear-gradient(135deg, #0066cc, #004499);
    transition: width 0.8s ease;
    position: relative;
}

.progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.progress-count {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 10px;
    font-weight: 600;
    color: #1f1f1f;
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

.btn-info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
}

.btn-info:hover {
    background: linear-gradient(135deg, #0891b2, #0e7490);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
}

/* Form Elements */
.form-control {
    padding: 12px 16px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.2s ease;
    outline: none;
    font-family: inherit;
}

.form-control:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

/* Report Period Info */
.report-period-card {
    background: rgba(248, 249, 250, 0.8);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    margin-top: 24px;
}

.report-period-card h6 {
    color: #1f1f1f;
    font-weight: 600;
    margin-bottom: 8px;
}

.report-period-card p {
    color: #666;
    font-size: 14px;
    margin: 0;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.empty-state i {
    font-size: 48px;
    color: #0066cc;
    margin-bottom: 16px;
    opacity: 0.5;
}

.empty-state h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #1f1f1f;
}

/* Print Styles */
@media print {
    .header-actions,
    .month-selector-card,
    .btn,
    .no-print {
        display: none !important;
    }
    
    .monthly-report-container {
        padding: 0;
        background: white;
    }
    
    .card {
        border: 1px solid #ddd;
        box-shadow: none;
        page-break-inside: avoid;
    }
    
    .summary-stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .monthly-report-container {
        padding: 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .header-actions {
        width: 100%;
        justify-content: stretch;
    }
    
    .month-selector-form {
        flex-direction: column;
        align-items: stretch;
    }
    
    .summary-stats-grid {
        grid-template-columns: 1fr;
    }
    
    .daily-stat-row {
        grid-template-columns: 1fr 50px;
        gap: 12px;
    }
    
    .daily-day {
        display: none;
    }
}
</style>

<div class="monthly-report-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="fas fa-calendar-alt"></i>
                Monthly Report
            </h1>
            <div class="month-subtitle"><?= h($monthName) ?></div>
            <?php if (isset($doctor->name)): ?>
                <div class="month-subtitle">Dr. <?= h($doctor->name) ?></div>
            <?php endif; ?>
        </div>
        <div class="header-actions no-print">
            <?= $this->Html->link('← Back to Reports', ['action' => 'index'], ['class' => 'btn btn-outline-primary']) ?>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Print Report
            </button>
        </div>
    </div>

    <!-- Doctor Info -->
    <?php if (isset($doctor->name)): ?>
    <div class="doctor-info-alert">
        <h5><i class="fas fa-user-md"></i> <?= h($doctor->name) ?></h5>
        <p>Department: <?= h($doctor->department->name ?? 'Unknown') ?> | Report Period: <?= date('F j, Y', strtotime($reportData['monthStart'])) ?> - <?= date('F j, Y', strtotime($reportData['monthEnd'])) ?></p>
    </div>
    <?php endif; ?>

    <!-- Month Selection -->
    <div class="month-selector-card no-print">
        <form method="get" class="month-selector-form">
            <div style="display: flex; align-items: center; gap: 12px;">
                <i class="fas fa-calendar-week" style="color: #0066cc;"></i>
                <strong>Select Different Month:</strong>
            </div>
            <input type="month" name="month" value="<?= h($month) ?>" class="form-control" style="width: auto;">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-search"></i> View Report
            </button>
        </form>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-stats-grid">
        <div class="summary-stat-card primary">
            <div class="stat-main-value"><?= $reportData['totalAppointments'] ?? 0 ?></div>
            <div class="stat-label">Total Appointments</div>
            <div class="stat-percentage neutral">100%</div>
        </div>
        <div class="summary-stat-card success">
            <div class="stat-main-value"><?= $reportData['completed'] ?? 0 ?></div>
            <div class="stat-label">Completed</div>
            <div class="stat-percentage positive">
                <?= $reportData['totalAppointments'] > 0 ? round(($reportData['completed'] / $reportData['totalAppointments']) * 100, 1) : 0 ?>%
            </div>
        </div>
        <div class="summary-stat-card warning">
            <div class="stat-main-value"><?= $reportData['cancelled'] ?? 0 ?></div>
            <div class="stat-label">Cancelled</div>
            <div class="stat-percentage negative">
                <?= $reportData['totalAppointments'] > 0 ? round(($reportData['cancelled'] / $reportData['totalAppointments']) * 100, 1) : 0 ?>%
            </div>
        </div>
        <div class="summary-stat-card danger">
            <div class="stat-main-value"><?= $reportData['noShow'] ?? 0 ?></div>
            <div class="stat-label">No Show</div>
            <div class="stat-percentage negative">
                <?= $reportData['totalAppointments'] > 0 ? round(($reportData['noShow'] / $reportData['totalAppointments']) * 100, 1) : 0 ?>%
            </div>
        </div>
    </div>

    <!-- Daily Breakdown -->
    <?php if (!empty($reportData['dailyStats'])): ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-chart-line"></i>
                Daily Appointment Distribution
            </h5>
        </div>
        <div class="card-body">
            <?php 
            $maxCount = max(array_column($reportData['dailyStats'], 'count'));
            if ($maxCount == 0) $maxCount = 1; // Prevent division by zero
            ?>
            <div class="daily-stats-grid">
                <?php foreach ($reportData['dailyStats'] as $day): 
                    $percentage = $maxCount > 0 ? ($day->count / $maxCount) * 100 : 0;
                ?>
                <div class="daily-stat-row">
                    <div class="daily-date"><?= h($day->appointment_date->format('M j')) ?></div>
                    <div class="daily-day"><?= h($day->appointment_date->format('D')) ?></div>
                    <div class="daily-count"><?= h($day->count) ?></div>
                    <div class="daily-progress">
                        <div class="progress-bar-container">
                            <div class="progress-bar" style="width: <?= $percentage ?>%"></div>
                            <?php if ($day->count > 0): ?>
                                <div class="progress-count"><?= $day->count ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="card">
        <div class="card-body">
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h4>No Appointments Found</h4>
                <p>No appointment data available for <?= h($monthName) ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Report Period Info -->
    <div class="report-period-card">
        <h6>Report Generated: <?= date('F j, Y \a\t g:i A') ?></h6>
        <p>Period: <?= date('F j, Y', strtotime($reportData['monthStart'])) ?> - <?= date('F j, Y', strtotime($reportData['monthEnd'])) ?></p>
    </div>
</div>