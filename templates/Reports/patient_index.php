<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="dashboard-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-history"></i>
            My Health History
        </h3>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold text-primary">Appointment History</h5>
                    <?= $this->Html->link(
                        '<i class="fas fa-plus"></i> New Appointment',
                        ['controller' => 'Appointments', 'action' => 'add'],
                        ['class' => 'btn btn-primary btn-sm rounded-pill', 'escape' => false]
                    ) ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                         <table class="table table-hover align-middle mb-0">
                             <thead class="bg-light">
                                 <tr>
                                     <th class="ps-4">Date</th>
                                     <th>Doctor</th>
                                     <th>Dept</th>
                                     <th>Status</th>
                                     <th>Actions</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($appointments as $appt): ?>
                                 <tr>
                                     <td class="ps-4 fw-bold"><?= h($appt->appointment_date->format('M d, Y')) ?></td>
                                     <td>Dr. <?= h($appt->doctor->name ?? 'Unknown') ?></td>
                                     <td><span class="badge bg-light text-dark border"><?= h($appt->doctor->department->name ?? '-') ?></span></td>
                                     <td>
                                         <?php 
                                            $statusClass = match($appt->status) {
                                                'Confirmed', 'Completed' => 'success',
                                                'Cancelled' => 'danger',
                                                'Scheduled' => 'primary',
                                                default => 'secondary'
                                            };
                                         ?>
                                         <span class="badge bg-<?= $statusClass ?>"><?= h($appt->status) ?></span>
                                     </td>
                                     <td>
                                         <?= $this->Html->link('View', ['controller' => 'Appointments', 'action' => 'view', $appt->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                                     </td>
                                 </tr>
                                 <?php endforeach; ?>
                                 <?php if (empty($appointments)): ?>
                                    <tr><td colspan="5" class="text-center py-5 text-muted">You have no appointment history.</td></tr>
                                 <?php endif; ?>
                             </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card bg-white h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3 p-3 d-inline-block rounded-circle bg-light text-success">
                        <i class="fas fa-file-medical-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Medical Records</h5>
                    <p class="text-muted small">View your past prescriptions and diagnosis reports.</p>
                    <button class="btn btn-outline-success btn-sm mt-2" disabled>Coming Soon</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-white h-100 border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="mb-3 p-3 d-inline-block rounded-circle bg-light text-info">
                        <i class="fas fa-file-invoice-dollar fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Billing & Invoices</h5>
                    <p class="text-muted small">View and download your payment receipts.</p>
                    <button class="btn btn-outline-info btn-sm mt-2" disabled>Coming Soon</button>
                </div>
            </div>
        </div>
    </div>
</div>