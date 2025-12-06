<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\WaitingList> $waitingList
 * @var \App\Model\Entity\User $user
 */
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-hourglass-half"></i>
            Waiting List
        </h3>
        <?php if ($user->role === 'patient'): ?>
            <?= $this->Html->link(
                '<i class="fas fa-plus"></i> Join Waiting List', 
                ['action' => 'add'], 
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <?php if ($waitingList->count() === 0): ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h5>No requests found</h5>
                <p>The waiting list is currently empty.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('priority') ?></th>
                            <th><?= $this->Paginator->sort('patient_id', 'Patient') ?></th>
                            <th>Preference</th>
                            <th><?= $this->Paginator->sort('preferred_date', 'Date') ?></th>
                            <th><?= $this->Paginator->sort('status') ?></th>
                            <th><?= $this->Paginator->sort('created_at', 'Requested') ?></th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($waitingList as $item): ?>
                        <tr>
                            <td>
                                <?php if($item->priority <= 3): ?>
                                    <span class="priority-badge priority-high">High</span>
                                <?php elseif($item->priority >= 8): ?>
                                    <span class="priority-badge priority-low">Low</span>
                                <?php else: ?>
                                    <span class="priority-badge priority-normal">Normal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= !empty($item->patient) ? $this->Html->link($item->patient->name, ['controller' => 'Patients', 'action' => 'view', $item->patient->id]) : '<span class="text-muted">Unknown</span>' ?>
                            </td>
                            <td>
                                <?php if (!empty($item->doctor)): ?>
                                    <div style="display:flex; align-items:center; gap:6px;">
                                        <i class="fas fa-user-md text-muted"></i> Dr. <?= h($item->doctor->name) ?>
                                    </div>
                                <?php elseif (!empty($item->department)): ?>
                                    <div style="display:flex; align-items:center; gap:6px;">
                                        <i class="fas fa-building text-muted"></i> <?= h($item->department->name) ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Any Available</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($item->preferred_date): ?>
                                    <div class="fw-bold"><?= h($item->preferred_date->format('M d, Y')) ?></div>
                                    <?php if ($item->preferred_time): ?>
                                        <div class="small text-muted">
                                            Around <?= h($item->preferred_time->format('h:i A')) ?>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted">ASAP</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $statusClass = 'badge-warning'; // Default pending
                                $statusIcon = 'fa-clock';
                                if ($item->status === 'notified') {
                                    $statusClass = 'badge-success';
                                    $statusIcon = 'fa-bell';
                                }
                                ?>
                                <span class="status-badge <?= $statusClass ?>">
                                    <i class="fas <?= $statusIcon ?>"></i>
                                    <?= ucfirst(h($item->status)) ?>
                                </span>
                            </td>
                            <td>
                                <span title="<?= $item->created_at->format('Y-m-d H:i') ?>">
                                    <?= h($item->created_at->timeAgoInWords()) ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-times"></i> Remove',
                                    ['action' => 'delete', $item->id],
                                    [
                                        'confirm' => __('Are you sure you want to remove this request?'),
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'escape' => false
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($waitingList->count() > 0): ?>
    <div class="pagination-container">
        <div class="pagination-info">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}')) ?>
        </div>
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('prev')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
    </div>
    <?php endif; ?>
</div>