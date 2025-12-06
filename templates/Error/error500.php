<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $statement
 * @var string $url
 * @var string $message
 */
$this->assign('title', 'System Error');
?>

<div class="card shadow-lg border-0 rounded-3">
    <div class="card-body p-5">
        <div class="mb-4 text-danger">
            <i class="fas fa-bug" style="font-size: 64px;"></i>
        </div>
        
        <h1 class="display-6 fw-bold text-dark mb-3">Something Went Wrong</h1>
        
        <p class="lead text-muted mb-4">
            We encountered an unexpected error. Our technical team has been notified. Please try again later.
        </p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <?= $this->Html->link(
                '<i class="fas fa-home me-2"></i> Back to Dashboard',
                '/',
                ['class' => 'btn btn-primary btn-lg px-4', 'escape' => false]
            ) ?>
        </div>
        
        <?php if (Configure::read('debug')): ?>
            <div class="mt-4 text-start bg-light p-3 rounded border">
                <strong>Debug Message:</strong><br>
                <?= h($message) ?>
            </div>
        <?php endif; ?>
    </div>
</div>