<?php
$this->assign('title', 'Page Not Found');
?>
<div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="glass-card text-center p-5" style="max-width: 500px;">
        <div class="mb-4 text-warning">
            <i class="fas fa-search-location" style="font-size: 64px;"></i>
        </div>
        <h1 class="h2 mb-3">Page Not Found</h1>
        <p class="text-muted mb-4">
            We couldn't find the page you were looking for. It may have been moved or deleted.
        </p>
        <?= $this->Html->link(
            '<i class="fas fa-home me-2"></i> Back to Home',
            '/',
            ['class' => 'btn btn-primary', 'escape' => false]
        ) ?>
    </div>
</div>