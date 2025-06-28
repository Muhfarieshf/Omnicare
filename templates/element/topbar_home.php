<?php
// templates/element/topbar_home.php
?>
<style>
.topbar {
    height: 56px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1050;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.topbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 24px;
    height: 100%;
    max-width: 1680px;
    margin: 0 auto;
}

.topbar-logo {
    display: flex;
    align-items: center;
}

.topbar-logo a {
    text-decoration: none;
    color: #1f1f1f;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.2s ease;
}

.topbar-logo a:hover {
    color: #0066cc;
}

.topbar-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-btn {
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.topbar-btn-outline {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.topbar-btn-outline:hover {
    background: #0066cc;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.topbar-btn-primary {
    background: #0066cc;
    color: white;
    border: 1px solid #0066cc;
    box-shadow: 0 1px 3px rgba(0, 102, 204, 0.2);
}

.topbar-btn-primary:hover {
    background: #0052a3;
    border-color: #0052a3;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.3);
}

/* Responsive design */
@media (max-width: 480px) {
    .topbar-container {
        padding: 0 16px;
    }
    
    .topbar-logo a {
        font-size: 16px;
    }
    
    .topbar-btn {
        padding: 6px 12px;
        font-size: 13px;
    }
    
    .topbar-actions {
        gap: 8px;
    }
}
</style>

<div class="topbar">
    <div class="topbar-container">
        <div class="topbar-logo">
            <?= $this->Html->link(
                '<span>🏥 OmniCare</span>',
                ['controller' => 'Pages', 'action' => 'home'],
                ['escape' => false]
            ) ?>
        </div>
        <div class="topbar-actions">
            <?= $this->Html->link(
                '<i class="fas fa-sign-in-alt"></i> Login', 
                ['controller' => 'Users', 'action' => 'login'], 
                ['class' => 'topbar-btn topbar-btn-outline', 'escape' => false]
            ) ?>
            <?= $this->Html->link(
                '<i class="fas fa-user-plus"></i> Register', 
                ['controller' => 'Users', 'action' => 'register'], 
                ['class' => 'topbar-btn topbar-btn-primary', 'escape' => false]
            ) ?>
        </div>
    </div>
</div>