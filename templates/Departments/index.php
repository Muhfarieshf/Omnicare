<div class="container-fluid d-flex justify-content-center px-0" style="max-width:1680px; overflow-x: clip;">
    <div class="row w-100 justify-content-left mx-0 gx-0" style="max-width:1680px; margin: 0 auto;">
        <div class="col-md-10 px-0" style="max-width: 100%;">
            <div class="departments index content py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0 text-left"><?= __('Departments') ?></h3>
                    <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                        <?= $this->Html->link('<i class="fas fa-plus"></i> ' . __('New Department'), ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
                    <?php endif; ?>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mx-0">
                    <?php foreach ($departments as $department): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm" style="min-height: 280px;">
                                <div class="row h-100 g-0 flex-row-reverse">
                                    <div class="col-5 d-flex align-items-center justify-content-center bg-light" style="min-height: 200px;">
                                        <i class="fas fa-building fa-4x text-secondary"></i>
                                    </div>
                                    <div class="col-7">
                                        <div class="card-body h-100 d-flex flex-column justify-content-between">
                                            <div>
                                                <h5 class="card-title mb-2">
                                                    <?= h($department->name) ?>
                                                </h5>
                                                <span class="badge bg-<?= h($department->status) === 'active' ? 'success' : 'secondary' ?> mb-2">
                                                    <?= h(ucfirst($department->status)) ?>
                                                </span>
                                            </div>
                                            <div class="d-flex gap-2 mt-auto">
                                                <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $department->id], ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false, 'title' => 'View']) ?>
                                                <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                                                    <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $department->id], ['class' => 'btn btn-sm btn-outline-secondary', 'escape' => false, 'title' => 'Edit']) ?>
                                                    <?= $this->Form->postLink(
                                                        '<i class="fas fa-trash"></i>',
                                                        ['action' => 'delete', $department->id],
                                                        [
                                                            'method' => 'delete',
                                                            'confirm' => __('Are you sure you want to delete # {0}?', $department->id),
                                                            'class' => 'btn btn-sm btn-outline-danger',
                                                            'escape' => false,
                                                            'title' => 'Delete'
                                                        ]
                                                    ) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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