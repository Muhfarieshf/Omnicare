<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Doctor> $doctors
 */
?>
<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="doctors index content py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 text-left"><?= __('Doctors') ?></h3>
                    <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                        <?= $this->Html->link('<i class="fas fa-plus"></i> ' . __('New Doctor'), ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('department_id', __('Department')) ?></th>
                                <th><?= $this->Paginator->sort('status') ?></th>
                                <th><?= $this->Paginator->sort('created_at') ?></th>
                                <th><?= $this->Paginator->sort('updated_at') ?></th>
                                <th class="actions text-center" style="width: 140px;"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($doctors as $doctor): ?>
                            <tr>
                                <td><?= $this->Number->format($doctor->id) ?></td>
                                <td><?= h($doctor->name) ?></td>
                                <td><?= $doctor->hasValue('department') ? $this->Html->link($doctor->department->name, ['controller' => 'Departments', 'action' => 'view', $doctor->department->id]) : '' ?></td>
                                <td><?= h($doctor->status) ?></td>
                                <td><?= h($doctor->created_at) ?></td>
                                <td><?= h($doctor->updated_at) ?></td>
                                <td class="actions text-center">
                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $doctor->id], ['class' => 'btn btn-sm btn-outline-primary me-1', 'escape' => false, 'title' => 'View']) ?>
                                    <?php if (isset($currentUser) && $currentUser->role !== 'patient'): ?>
                                        <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $doctor->id], ['class' => 'btn btn-sm btn-outline-secondary me-1', 'escape' => false, 'title' => 'Edit']) ?>
                                        <?= $this->Form->postLink(
                                            '<i class="fas fa-trash"></i>',
                                            ['action' => 'delete', $doctor->id],
                                            [
                                                'method' => 'delete',
                                                'confirm' => __('Are you sure you want to delete # {0}?', $doctor->id),
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
                <div class="paginator mt-4">
                    <ul class="pagination mb-2">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous'), ['class' => 'page-link']) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >', ['class' => 'page-link']) ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p class="text-muted small mb-0">
                        <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>