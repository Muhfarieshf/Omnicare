<div class="list-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-building"></i>
            <?= __('Departments') ?>
        </h1>
        <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
            <?= $this->Html->link(
                '<i class="fas fa-plus"></i> ' . __('New Department'),
                ['action' => 'add'],
                ['class' => 'btn btn-success', 'escape' => false]
            ) ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($departments)): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-bottom: 40px;">
            <?php foreach ($departments as $department): ?>
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div style="width: 48px; height: 48px; background: #eef2ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 16px; color: var(--primary-color);">
                                <i class="fas fa-hospital" style="font-size: 24px;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1"><?= h($department->name) ?></h5>
                                <span class="status-badge <?= h($department->status) === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                    <?= h(ucfirst($department->status)) ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-auto pt-3 border-top d-flex gap-2">
                            <?= $this->Html->link(
                                '<i class="fas fa-eye"></i> View',
                                ['action' => 'view', $department->id],
                                ['class' => 'btn btn-sm btn-outline-primary w-100', 'escape' => false]
                            ) ?>
                            
                            <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                                <?= $this->Html->link(
                                    '<i class="fas fa-edit"></i>',
                                    ['action' => 'edit', $department->id],
                                    ['class' => 'btn btn-sm btn-outline-primary', 'escape' => false]
                                ) ?>
                                <?= $this->Form->postLink(
                                    '<i class="fas fa-trash"></i>',
                                    ['action' => 'delete', $department->id],
                                    [
                                        'confirm' => __('Delete {0}?', $department->name),
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'escape' => false
                                    ]
                                ) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-building"></i>
            <h5>No Departments Found</h5>
            <p>No departments have been created yet.</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($departments)): ?>
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