<?php
/**
 * @var \App\View\AppView $this
 * @var string $title
 * @var string $placeholder
 */
$searchQuery = $this->request->getQuery('q', '');
?>

<div class="search-widget mb-4">
    <div class="card border-0 shadow-sm" style="background: rgba(255, 255, 255, 0.9);">
        <div class="card-body p-3">
            <form method="get" action="">
                <div class="d-flex gap-3 align-items-center">
                    <div class="flex-grow-1 position-relative">
                        <i class="fas fa-search text-muted position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                        <input 
                            type="text" 
                            name="q" 
                            class="form-control ps-5 border-0 bg-light" 
                            placeholder="<?= h($placeholder ?? 'Search...') ?>" 
                            value="<?= h($searchQuery) ?>"
                            style="padding-top: 12px; padding-bottom: 12px;"
                        >
                    </div>
                    <?php if (!empty($searchQuery)): ?>
                        <?= $this->Html->link('Clear', ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary px-4">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>