<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $statement
 * @var string $url
 * @var string $message
 */
$this->assign('title', 'Page Not Found');
?>

<div class="card shadow-lg border-0 rounded-3">
    <div class="card-body p-5">
        <div class="mb-4 text-warning">
            <i class="fas fa-exclamation-triangle" style="font-size: 64px;"></i>
        </div>
        
        <h1 class="display-6 fw-bold text-dark mb-3">Page Not Found</h1>
        
        <p class="lead text-muted mb-4">
            The page you requested could not be found. It might have been moved, deleted, or you may have typed the URL incorrectly.
        </p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <?= $this->Html->link(
                '<i class="fas fa-home me-2"></i> Back to Dashboard',
                '/',
                ['class' => 'btn btn-primary btn-lg px-4', 'escape' => false]
            ) ?>
            
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-lg px-4">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </a>
        </div>
    </div>
</div>