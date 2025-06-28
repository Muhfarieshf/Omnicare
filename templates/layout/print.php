<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Schedule - <?= h($doctor->name ?? '') ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .doctor-info {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #007bff;
        }
        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .appointments-table th,
        .appointments-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .appointments-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .appointments-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-scheduled { color: #007bff; }
        .status-completed { color: #28a745; }
        .status-cancelled { color: #dc3545; }
        .status-no-show { color: #ffc107; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>

<!-- CREATE FILE: templates/Reports/print_daily_schedule.php -->
<div class="header">
    <h1>Daily Schedule</h1>
    <h2><?= h($date ? date('l, F j, Y', strtotime($date)) : date('l, F j, Y')) ?></h2>
</div>

<div class="doctor-info">
    <strong>Doctor:</strong> <?= h($doctor->name ?? 'Unknown') ?><br>
    <strong>Department:</strong> <?= h($doctor->department->name ?? 'Unknown') ?><br>
    <strong>Generated:</strong> <?= date('M j, Y g:i A') ?>
</div>

<?php if (empty($appointments)): ?>
    <div style="text-align: center; padding: 40px; background: #f8f9fa; border: 1px dashed #ccc;">
        <h3>No Appointments Scheduled</h3>
        <p>No appointments found for this date.</p>
    </div>
<?php else: ?>
    <table class="appointments-table">
        <thead>
            <tr>
                <th style="width: 15%;">Time</th>
                <th style="width: 30%;">Patient Name</th>
                <th style="width: 20%;">Contact</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 20%;">Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><strong><?= h($appointment->appointment_time->format('g:i A')) ?></strong></td>
                <td><?= h($appointment->patient->name ?? 'Unknown Patient') ?></td>
                <td><?= h($appointment->patient->contact_number ?? 'No contact') ?></td>
                <td class="status-<?= strtolower(str_replace(' ', '-', $appointment->status)) ?>">
                    <?= h($appointment->status) ?>
                </td>
                <td style="font-size: 12px;"><?= h($appointment->remarks) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <strong>Summary:</strong>
        <ul style="list-style: none; padding: 0;">
            <li>📅 <strong>Total Appointments:</strong> <?= count($appointments) ?></li>
            <li>⏰ <strong>First Appointment:</strong> <?= h(reset($appointments)->appointment_time->format('g:i A')) ?></li>
            <li>🕐 <strong>Last Appointment:</strong> <?= h(end($appointments)->appointment_time->format('g:i A')) ?></li>
        </ul>
    </div>
<?php endif; ?>

<div class="footer">
    <p>Onmnicare | Generated on <?= date('Y-m-d H:i:s') ?></p>
</div>