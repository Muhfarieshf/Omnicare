<?php
$this->assign('title', 'System Error');
?>
<div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="glass-card text-center p-5" style="max-width: 500px;">
        <div class="mb-4 text-danger">
            <i class="fas fa-exclamation-circle" style="font-size: 64px;"></i>
        </div>
        <h1 class="h2 mb-3">System Error</h1>
        <p class="text-muted mb-4">
            Something went wrong on our end. Our technical team has been notified.
        </p>
        <?= $this->Html->link(
            '<i class="fas fa-redo me-2"></i> Try Again',
            'javascript:location.reload()',
            ['class' => 'btn btn-outline-primary me-2', 'escape' => false]
        ) ?>
        <?= $this->Html->link(
            'Go Home',
            '/',
            ['class' => 'btn btn-primary', 'escape' => false]
        ) ?>
    </div>
</div>