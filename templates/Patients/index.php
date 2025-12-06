<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Patient> $patients
 */
$currentUser = $this->getRequest()->getAttribute('identity');
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-users"></i>
            <?= __('Patients') ?>
        </h3>
        <?php if ($currentUser && $currentUser->role !== 'doctor'): ?>
            <?= $this->Html->link(
                '<i class="fas fa-user-plus"></i> New Patient', 
                ['action' => 'add'], 
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <?php if (empty($patients)): ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h5>No patients found</h5>
                <p>No patient records are available at this time.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                            <th><?= $this->Paginator->sort('name', 'Patient') ?></th>
                            <th><?= $this->Paginator->sort('contact_number', 'Phone') ?></th>
                            <th><?= $this->Paginator->sort('email', 'Email') ?></th>
                            <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                            <th style="text-align: center;"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?= $this->Number->format($patient->id) ?></td>
                            <td style="font-weight: 600;"><?= h($patient->name) ?></td>
                            <td><?= h($patient->contact_number ?? '-') ?></td>
                            <td><?= h($patient->email ?? '-') ?></td>
                            <td>
                                <span class="status-badge <?= $patient->status === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                    <?= h(ucfirst($patient->status ?? 'Active')) ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $patient->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                <?php if ($currentUser && $currentUser->role !== 'doctor'): ?>
                                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $patient->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(
                                        '<i class="fas fa-trash"></i>',
                                        ['action' => 'delete', $patient->id],
                                        [
                                            'confirm' => __('Are you sure you want to delete # {0}?', $patient->id),
                                            'class' => 'btn btn-sm btn-outline-danger',
                                            'escape' => false
                                        ]
                                    ) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($patients)): ?>
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