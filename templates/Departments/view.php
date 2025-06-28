<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="container-fluid d-flex justify-content-center" style="max-width:1680px;">
    <div class="row w-100 justify-content-left">
        <div class="col-md-10">
            <div class="departments view content py-4">
                <h3 class="mb-4 text-left"><?= h($department->name) ?></h3>
                <table class="table table-bordered table-striped mb-4">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($department->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Status') ?></th>
                        <td><?= h($department->status) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Id') ?></th>
                        <td><?= $this->Number->format($department->id) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created At') ?></th>
                        <td><?= h($department->created_at) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Updated At') ?></th>
                        <td><?= h($department->updated_at) ?></td>
                    </tr>
                </table>
                <div class="d-flex mb-4">
                    <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                        <?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id], ['class' => 'btn btn-primary me-2']) ?>
                        <?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id), 'class' => 'btn btn-danger me-2']) ?>
                        <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                    <?php endif; ?>
                </div>
                <div class="related">
                    <h4><?= __('Related Doctors') ?></h4>
                    <?php if (!empty($department->doctors)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th><?= __('Id') ?></th>
                                    <th><?= __('Name') ?></th>
                                    <th><?= __('Department Id') ?></th>
                                    <th><?= __('Status') ?></th>
                                    <th><?= __('Created At') ?></th>
                                    <th><?= __('Updated At') ?></th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($department->doctors as $doctor) : ?>
                                <tr>
                                    <td><?= h($doctor->id) ?></td>
                            <td><?= h($doctor->name) ?></td>
                            <td><?= h($doctor->department_id) ?></td>
                            <td><?= h($doctor->status) ?></td>
                            <td><?= h($doctor->created_at) ?></td>
                            <td><?= h($doctor->updated_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Doctors', 'action' => 'view', $doctor->id]) ?>
                                <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Doctors', 'action' => 'edit', $doctor->id]) ?>
                                    <?= $this->Form->postLink(
                                        __('Delete'),
                                        ['controller' => 'Doctors', 'action' => 'delete', $doctor->id],
                                        [
                                            'method' => 'delete',
                                            'confirm' => __('Are you sure you want to delete # {0}?', $doctor->id),
                                        ]
                                    ) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>