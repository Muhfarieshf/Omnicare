<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Patient> $patients
 */
$currentUser = $this->getRequest()->getAttribute('identity');
?>
<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="patients index content py-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0 text-left"><?= __('Patients') ?></h3>
                    <?php if ($currentUser && $currentUser->role !== 'doctor'): ?>
                        <?= $this->Html->link(__('New Patient'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('dob') ?></th>
                    <th><?= $this->Paginator->sort('contact_number') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= $this->Number->format($patient->id) ?></td>
                    <td><?= h($patient->name) ?></td>
                    <td><?= h($patient->gender) ?></td>
                    <td><?= h($patient->dob) ?></td>
                    <td><?= h($patient->contact_number) ?></td>
                    <td><?= h($patient->email) ?></td>
                    <td><?= h($patient->status) ?></td>
                    <td><?= h($patient->created_at) ?></td>
                    <td><?= h($patient->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $patient->id], ['class' => 'btn btn-sm btn-outline-primary me-1', 'escape' => false, 'title' => 'View']) ?>
                        <?php if ($currentUser && $currentUser->role !== 'doctor'): ?>
                            <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $patient->id], ['class' => 'btn btn-sm btn-outline-secondary me-1', 'escape' => false, 'title' => 'Edit']) ?>
                            <?= $this->Form->postLink(
                                '<i class="fas fa-trash"></i>',
                                ['action' => 'delete', $patient->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $patient->id),
                                    'class' => 'btn btn-sm btn-outline-danger',
                                    'escape' => false,
                                    'title' => 'Delete'
                                ]
                            ) ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
                <div class="paginator mt-3">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous'), ['class' => 'page-link']) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >', ['class' => 'page-link']) ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>