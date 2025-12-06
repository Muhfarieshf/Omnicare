<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $appointments
 * @var string $date
 */
$this->assign('title', 'Daily Schedule - ' . $date);
?>

<style>
    /* Print-specific overrides */
    @media print {
        .no-print { display: none !important; }
        body { background: white !important; font-size: 12pt; }
        .container { max-width: 100% !important; padding: 0; }
        .card { border: none !important; box-shadow: none !important; }
    }
    .schedule-time { font-weight: bold; width: 100px; }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <div>
            <h2 class="mb-0 text-primary">Daily Schedule</h2>
            <p class="text-muted mb-0">Date: <strong><?= date('l, F j, Y', strtotime($date)) ?></strong></p>
        </div>
        <div class="no-print">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-2"></i> Print
            </button>
            <?= $this->Html->link('Back', ['action' => 'index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
        </div>
    </div>

    <?php if (empty($appointments)): ?>
        <div class="alert alert-info text-center">
            No appointments scheduled for this date.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Time</th>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appt): ?>
                    <tr>
                        <td class="schedule-time"><?= h($appt->appointment_time->format('H:i')) ?></td>
                        <td>
                            <strong><?= h($appt->patient->name) ?></strong>
                            <br>
                            <small class="text-muted"><?= h($appt->patient->contact_number) ?></small>
                        </td>
                        <td>Dr. <?= h($appt->doctor->name) ?></td>
                        <td><?= h($appt->status) ?></td>
                        <td><?= h($appt->remarks) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="mt-5 pt-3 border-top text-muted small text-center">
        Printed from OmniCare System
    </div>
</div>