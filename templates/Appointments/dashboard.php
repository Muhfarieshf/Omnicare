<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #1f1f1f;
    line-height: 1.6;
    min-height: 100vh;
    padding-top: 56px; /* Account for fixed topbar */
}

/* Background Animation */
body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 102, 204, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
    z-index: -1;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(30px, -30px) rotate(120deg); }
    66% { transform: translate(-20px, 20px) rotate(240deg); }
}

/* Main Container */
.dashboard-container {
    max-width: 1680px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Dashboard Header */
.dashboard-header {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #0066cc, #22c55e, #0066cc);
    background-size: 200% 100%;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.dashboard-title {
    font-size: 32px;
    font-weight: 700;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.dashboard-title i {
    color: #0066cc;
    font-size: 28px;
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    padding: 28px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
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

.stat-card.warning {
    --gradient: linear-gradient(135deg, #f59e0b, #d97706);
}

.stat-card.info {
    --gradient: linear-gradient(135deg, #06b6d4, #0891b2);
}

.stat-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-details h4 {
    font-size: 36px;
    font-weight: 700;
    color: #1f1f1f;
    margin-bottom: 6px;
    line-height: 1;
}

.stat-details p {
    color: #666;
    font-size: 14px;
    font-weight: 500;
    margin: 0;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: white;
    background: var(--gradient);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Content Grid */
.content-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 32px;
}

/* Glass Cards */
.glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
}

.glass-card:hover {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.card-header {
    padding: 24px 28px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(0, 102, 204, 0.02);
}

.card-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f1f1f;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.card-title i {
    color: #0066cc;
    font-size: 18px;
}

.card-body {
    padding: 28px;
}

/* Tables */
.table-container {
    overflow-x: auto;
    border-radius: 12px;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.custom-table th,
.custom-table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    font-size: 14px;
}

.custom-table th {
    font-weight: 600;
    color: #666;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: rgba(0, 102, 204, 0.02);
}

.custom-table tbody tr {
    transition: all 0.2s ease;
}

.custom-table tbody tr:hover {
    background: rgba(0, 102, 204, 0.05);
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-completed {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.badge-cancelled {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.badge-scheduled {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.badge-pending {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.badge-info {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.badge-warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.status-badge i {
    font-size: 10px;
    margin-right: 4px;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 48px 24px;
    color: #666;
}

.empty-state i {
    font-size: 56px;
    color: #ccc;
    margin-bottom: 20px;
}

.empty-state p {
    font-size: 16px;
    margin: 0;
    color: #666;
}

/* Time Formatting */
.time-cell {
    font-weight: 600;
    color: #0066cc;
}

.date-cell {
    font-weight: 500;
    color: #666;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 20px 16px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .dashboard-header {
        padding: 24px;
    }
    
    .dashboard-title {
        font-size: 24px;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-details h4 {
        font-size: 28px;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        font-size: 20px;
    }
    
    .card-header,
    .card-body {
        padding: 20px;
    }
    
    .custom-table th,
    .custom-table td {
        padding: 12px 16px;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .stat-content {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .custom-table {
        font-size: 12px;
    }
    
    .custom-table th,
    .custom-table td {
        padding: 8px 12px;
    }
}
</style>

<div class="container-fluid">
    <!-- Add search widget at the top -->
    <?= $this->element('search_widget', [
        'title' => 'Quick Search',
        'placeholder' => 'Search appointments, patients...'
    ]) ?>

    <!-- Rest of your dashboard content -->
    <div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-tachometer-alt"></i>
            Admin Dashboard
        </h1>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= $totalPatients ?></h4>
                    <p>Total Patients</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= $totalDoctors ?></h4>
                    <p>Total Doctors</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= $todaysCount ?></h4>
                    <p>Today's Appointments</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card info">
            <div class="stat-content">
                <div class="stat-details">
                    <h4><?= $totalAppointments ?></h4>
                    <p>Total Appointments</p>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        <!-- Today's Appointments -->
        <div class="glass-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-day"></i>
                    Today's Appointments
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($todaysAppointments)): ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times"></i>
                        <p>No appointments scheduled for today.</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todaysAppointments as $appointment): ?>
                                <tr>
                                    <td class="time-cell"><?= h($appointment->appointment_time->format('H:i')) ?></td>
                                    <td><?= h($appointment->patient->name) ?></td>
                                    <td><?= h($appointment->doctor->name) ?></td>
                                    <td><?= h($appointment->duration_minutes ?? 30) ?> min</td>
                                    <td>
                                        <?php
                                        $badgeClass = 'badge-scheduled';
                                        $statusIcon = 'fa-calendar-check';
                                        switch ($appointment->status) {
                                            case 'Confirmed':
                                                $badgeClass = 'badge-info';
                                                $statusIcon = 'fa-check-circle';
                                                break;
                                            case 'In Progress':
                                                $badgeClass = 'badge-warning';
                                                $statusIcon = 'fa-spinner';
                                                break;
                                            case 'Completed':
                                                $badgeClass = 'badge-completed';
                                                $statusIcon = 'fa-check-circle';
                                                break;
                                            case 'Cancelled':
                                                $badgeClass = 'badge-cancelled';
                                                $statusIcon = 'fa-times-circle';
                                                break;
                                            case 'No Show':
                                                $badgeClass = 'badge-warning';
                                                $statusIcon = 'fa-exclamation-triangle';
                                                break;
                                            case 'Pending Approval':
                                                $badgeClass = 'badge-pending';
                                                $statusIcon = 'fa-clock';
                                                break;
                                            default:
                                                $badgeClass = 'badge-scheduled';
                                                $statusIcon = 'fa-calendar-check';
                                        }
                                        ?>
                                        <span class="status-badge <?= $badgeClass ?>">
                                            <i class="fas <?= $statusIcon ?>"></i>
                                            <?= h($appointment->status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $this->Html->link(
                                            '<i class="fas fa-eye"></i> View',
                                            ['action' => 'view', $appointment->id],
                                            ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]
                                        ) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="glass-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-week"></i>
                    Upcoming Appointments (Next 7 Days)
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($upcomingAppointments)): ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-plus"></i>
                        <p>No upcoming appointments.</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($upcomingAppointments as $appointment): ?>
                                <tr>
                                    <td class="date-cell"><?= h($appointment->appointment_date->format('M d')) ?></td>
                                    <td class="time-cell"><?= h($appointment->appointment_time->format('H:i')) ?></td>
                                    <td><?= h($appointment->patient->name) ?></td>
                                    <td><?= h($appointment->doctor->name) ?></td>
                                    <td><?= h($appointment->duration_minutes ?? 30) ?> min</td>
                                    <td>
                                        <?php
                                        $badgeClass = 'badge-scheduled';
                                        $statusIcon = 'fa-calendar-check';
                                        switch ($appointment->status) {
                                            case 'Confirmed':
                                                $badgeClass = 'badge-info';
                                                $statusIcon = 'fa-check-circle';
                                                break;
                                            case 'In Progress':
                                                $badgeClass = 'badge-warning';
                                                $statusIcon = 'fa-spinner';
                                                break;
                                            case 'Completed':
                                                $badgeClass = 'badge-completed';
                                                $statusIcon = 'fa-check-circle';
                                                break;
                                            case 'Cancelled':
                                                $badgeClass = 'badge-cancelled';
                                                $statusIcon = 'fa-times-circle';
                                                break;
                                            case 'No Show':
                                                $badgeClass = 'badge-warning';
                                                $statusIcon = 'fa-exclamation-triangle';
                                                break;
                                            case 'Pending Approval':
                                                $badgeClass = 'badge-pending';
                                                $statusIcon = 'fa-clock';
                                                break;
                                            default:
                                                $badgeClass = 'badge-scheduled';
                                                $statusIcon = 'fa-calendar-check';
                                        }
                                        ?>
                                        <span class="status-badge <?= $badgeClass ?>">
                                            <i class="fas <?= $statusIcon ?>"></i>
                                            <?= h($appointment->status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $this->Html->link(
                                            '<i class="fas fa-eye"></i> View',
                                            ['action' => 'view', $appointment->id],
                                            ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]
                                        ) ?>
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
</div>