<?php
// ===== MODERN TOPBAR ELEMENT =====
// File: templates/element/topbar.php

$user = $this->getRequest()->getAttribute('identity');
$displayName = null;
if ($user) {
    if ($user->role === 'admin') {
        $displayName = $user->username;
    } elseif (property_exists($user, 'patient_id') && $user->patient_id && property_exists($user, 'patient') && !empty($user->patient->name)) {
        $displayName = $user->patient->name;
    } elseif (property_exists($user, 'doctor_id') && $user->doctor_id && property_exists($user, 'doctor') && !empty($user->doctor->name)) {
        $displayName = $user->doctor->name;
    } elseif (property_exists($user, 'name') && !empty($user->name)) {
        $displayName = $user->name;
    } else {
        $displayName = $user->username;
    }
}
?>

<style>
.modern-topbar {
    height: 64px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1050;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
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

.topbar-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.topbar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-logo a {
    text-decoration: none;
    color: #0066cc;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
}

.topbar-logo i {
    font-size: 20px;
}

.topbar-logo a:hover {
    color: #0052a3;
    transform: scale(1.02);
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #666;
    font-size: 14px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 16px;
    background: linear-gradient(135deg, #0066cc, #004499);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    font-weight: 600;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge.admin {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.role-badge.doctor {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.role-badge.patient {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.role-badge.staff {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
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
    border: none;
    cursor: pointer;
}

.topbar-btn:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
}

.topbar-btn-outline {
    background: transparent;
    color: #e11d48;
    border: 1px solid #e11d48;
}

.topbar-btn-outline:hover {
    background: #e11d48;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.2);
}

.topbar-btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    border: 1px solid transparent;
    box-shadow: 0 1px 3px rgba(0, 102, 204, 0.2);
}

.topbar-btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.3);
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: #666;
    font-size: 20px;
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.menu-toggle:hover {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .topbar-container {
        padding: 0 16px;
    }
    
    .topbar-left {
        gap: 12px;
    }
    
    .topbar-logo a {
        font-size: 16px;
    }
    
    .user-info span {
        display: none;
    }
    
    .menu-toggle {
        display: block;
    }
    
    .topbar-btn {
        padding: 6px 12px;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .topbar-right {
        gap: 8px;
    }
    
    .role-badge {
        display: none;
    }
}
</style>

<div class="modern-topbar">
    <div class="topbar-container">
        <div class="topbar-left">
            <button class="menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="topbar-logo">
                <?php if (!$user): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-hospital"></i><span>OmniCare</span>',
                        ['controller' => 'Pages', 'action' => 'home'],
                        ['escape' => false]
                    ) ?>
                <?php else: ?>
                    <a href="#">
                        <i class="fas fa-hospital"></i>
                        <span>OmniCare</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="topbar-right">
            <?php if ($user): ?>
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr($displayName, 0, 1)) ?>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #1f1f1f;">
                            <?= h($displayName) ?>
                        </span>
                        <div class="role-badge <?= $user->role ?>">
                            <?= ucfirst($user->role) ?>
                        </div>
                    </div>
                </div>
                
                <?= $this->Html->link(
                    '<i class="fas fa-sign-out-alt"></i> Logout',
                    ['controller' => 'Users', 'action' => 'logout'],
                    ['class' => 'topbar-btn topbar-btn-outline', 'escape' => false]
                ) ?>
            <?php else: ?>
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
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Mobile menu toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            if (overlay) overlay.classList.toggle('show');
        });
    }
});
</script>