<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Appointment> $todaysAppointments
 * @var iterable<\App\Model\Entity\Appointment> $upcomingAppointments
 */
?>

<div class="dashboard-container">
    <div class="dashboard-header mb-4">
        <h1 class="dashboard-title">
            <i class="fas fa-tachometer-alt"></i>
            Admin Dashboard
        </h1>
    </div>

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

    <div class="content-grid">
        <div class="glass-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-day"></i>
                    Today's Appointments
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($todaysAppointments)): ?>
                    <div class="empty-state text-center py-4">
                        <i class="fas fa-calendar-times" style="font-size: 32px; color: #ccc;"></i>
                        <p class="mt-2 text-muted">No appointments scheduled for today.</p>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($todaysAppointments as $appointment): ?>
                                <tr>
                                    <td class="time-cell" style="font-weight: 600; color: #0066cc;">
                                        <?= h($appointment->appointment_time->format('H:i')) ?>
                                    </td>
                                    <td><?= h($appointment->patient->name) ?></td>
                                    <td><?= h($appointment->doctor->name) ?></td>
                                    <td>
                                        <?php
                                        $badgeClass = 'badge-scheduled';
                                        $statusIcon = 'fa-calendar-check';
                                        switch ($appointment->status) {
                                            case 'Confirmed': $badgeClass = 'badge-info'; $statusIcon = 'fa-check-circle'; break;
                                            case 'In Progress': $badgeClass = 'badge-warning'; $statusIcon = 'fa-spinner'; break;
                                            case 'Completed': $badgeClass = 'badge-success'; $statusIcon = 'fa-check-circle'; break;
                                            case 'Cancelled': $badgeClass = 'badge-danger'; $statusIcon = 'fa-times-circle'; break;
                                            case 'No Show': $badgeClass = 'badge-warning'; $statusIcon = 'fa-exclamation-triangle'; break;
                                            case 'Pending Approval': $badgeClass = 'badge-warning'; $statusIcon = 'fa-clock'; break;
                                        }
                                        ?>
                                        <span class="status-badge <?= $badgeClass ?>">
                                            <i class="fas <?= $statusIcon ?>"></i>
                                            <?= h($appointment->status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $this->Html->link(
                                            '<i class="fas fa-eye"></i>',
                                            ['action' => 'view', $appointment->id],
                                            ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']
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

        <div class="glass-card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-week"></i>
                    Upcoming (Next 7 Days)
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($upcomingAppointments)): ?>
                    <div class="empty-state text-center py-4">
                        <i class="fas fa-calendar-plus" style="font-size: 32px; color: #ccc;"></i>
                        <p class="mt-2 text-muted">No upcoming appointments.</p>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($upcomingAppointments as $appointment): ?>
                                <tr>
                                    <td style="font-weight: 500;">
                                        <?= h($appointment->appointment_date->format('M d')) ?>
                                    </td>
                                    <td class="time-cell"><?= h($appointment->appointment_time->format('H:i')) ?></td>
                                    <td><?= h($appointment->patient->name) ?></td>
                                    <td><?= h($appointment->doctor->name) ?></td>
                                    <td>
                                        <?= $this->Html->link(
                                            '<i class="fas fa-eye"></i>',
                                            ['action' => 'view', $appointment->id],
                                            ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']
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