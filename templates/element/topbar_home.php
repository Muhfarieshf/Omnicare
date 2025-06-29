<?php
// templates/element/topbar_home.php
?>
<style>
/* TOPBAR STYLES - Higher specificity to override conflicts */
.topbar {
    height: 56px !important;
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 1050 !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px) !important;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
}

.topbar-container {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 0 24px !important;
    height: 100% !important;
    max-width: 1680px !important;
    margin: 0 auto !important;
    width: 100% !important;
}

/* LEFT SIDE - Logo (Force left alignment) */
.topbar-logo {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    flex: 0 0 auto !important;
    order: 1 !important;
}

.topbar-logo a {
    text-decoration: none !important;
    color: #1f1f1f !important;
    font-weight: 600 !important;
    font-size: 18px !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    transition: color 0.2s ease !important;
    white-space: nowrap !important;
}

.topbar-logo a:hover {
    color: #0066cc !important;
    text-decoration: none !important;
}

/* RIGHT SIDE - Actions (Force right alignment) */
.topbar-actions {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    gap: 12px !important;
    flex: 0 0 auto !important;
    order: 2 !important;
    margin-left: auto !important;
}

.topbar-btn {
    padding: 8px 16px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border-radius: 6px !important;
    text-decoration: none !important;
    transition: all 0.2s ease !important;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    white-space: nowrap !important;
    border: 1px solid transparent !important;
}

.topbar-btn-outline {
    background: transparent !important;
    color: #0066cc !important;
    border: 1px solid #0066cc !important;
}

.topbar-btn-outline:hover {
    background: #0066cc !important;
    color: white !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2) !important;
    text-decoration: none !important;
}

.topbar-btn-primary {
    background: #0066cc !important;
    color: white !important;
    border: 1px solid #0066cc !important;
    box-shadow: 0 1px 3px rgba(0, 102, 204, 0.2) !important;
}

.topbar-btn-primary:hover {
    background: #0052a3 !important;
    border-color: #0052a3 !important;
    color: white !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.3) !important;
    text-decoration: none !important;
}

/* Responsive design */
@media (max-width: 480px) {
    .topbar-container {
        padding: 0 16px !important;
    }
    
    .topbar-logo a {
        font-size: 16px !important;
    }
    
    .topbar-btn {
        padding: 6px 12px !important;
        font-size: 13px !important;
    }
    
    .topbar-actions {
        gap: 8px !important;
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