<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.user-view-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0 32px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
}

/* User Info Card */
.user-info-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 32px;
}

.user-info-header {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
}

.user-avatar {
    width: 64px;
    height: 64px;
    border-radius: 32px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
}

.user-basic-info h3 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 4px;
}

.user-basic-info p {
    opacity: 0.9;
    font-size: 16px;
    margin: 0;
    text-transform: capitalize;
}

.user-details {
    padding: 24px;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-size: 12px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 14px;
    color: #1f1f1f;
    font-weight: 500;
}

.detail-value a {
    color: #0066cc;
    text-decoration: none;
    transition: color 0.2s ease;
}

.detail-value a:hover {
    color: #0052a3;
    text-decoration: underline;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.active {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-badge.inactive,
.status-badge.disabled {
    background: rgba(156, 163, 175, 0.1);
    color: #6b7280;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 32px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: inherit;
}

.btn:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #e11d48, #be185d);
    color: white;
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.2);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #be185d, #9f1239);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(225, 29, 72, 0.3);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    box-shadow: 0 2px 8px rgba(107, 114, 128, 0.2);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #4b5563, #374151);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .user-view-container {
        padding: 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .user-info-header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn {
        justify-content: center;
    }
}
</style>

<div class="user-view-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-user-circle"></i>
            User Profile
        </h3>
    </div>

    <div class="user-info-card">
        <div class="user-info-header">
            <div class="user-avatar">
                <?= strtoupper(substr($user->username, 0, 1)) ?>
            </div>
            <div class="user-basic-info">
                <h3><?= h($user->username) ?></h3>
                <p><?= h($user->role) ?></p>
            </div>
        </div>
        <div class="user-details">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">User ID</div>
                    <div class="detail-value"><?= $this->Number->format($user->id) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Role</div>
                    <div class="detail-value" style="text-transform: capitalize;"><?= h($user->role) ?></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <span class="status-badge <?= strtolower($user->status ?? 'inactive') ?>">
                            <?= h($user->status ?? 'Inactive') ?>
                        </span>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">
                        <?php if (!empty($user->email)): ?>
                            <a href="mailto:<?= h($user->email) ?>"><?= h($user->email) ?></a>
                        <?php else: ?>
                            Not Provided
                        <?php endif; ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Created</div>
                    <div class="detail-value">
                        <?= h($user->created_at ? $user->created_at->format('M d, Y g:i A') : 'N/A') ?>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Last Updated</div>
                    <div class="detail-value">
                        <?= h($user->updated_at ? $user->updated_at->format('M d, Y g:i A') : 'N/A') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <?php if (isset($currentUser) && $currentUser->role !== 'patient' && $currentUser->role !== 'user'): ?>
            <?= $this->Html->link('<i class="fas fa-edit"></i> Edit User', ['action' => 'edit', $user->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
            <?= $this->Form->postLink('<i class="fas fa-trash"></i> Delete User', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger', 'escape' => false]) ?>
            <?= $this->Html->link('<i class="fas fa-list"></i> List Users', ['action' => 'index'], ['class' => 'btn btn-secondary', 'escape' => false]) ?>
            <?= $this->Html->link('<i class="fas fa-user-plus"></i> New User', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
        <?php elseif (isset($currentUser) && $currentUser->id === $user->id): ?>
             <?= $this->Html->link('<i class="fas fa-edit"></i> Edit Profile', ['action' => 'edit', $user->id], ['class' => 'btn btn-primary', 'escape' => false]) ?>
        <?php endif; ?>
         <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back to List', ['action' => 'index'], ['class' => 'btn btn-secondary', 'escape' => false]) ?>
    </div>
</div>