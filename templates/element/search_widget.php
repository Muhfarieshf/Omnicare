<?php
/**
 * Search Widget Component - OmniCare Design System
 * Now properly aligned with dashboard containers
 */

$title = $title ?? 'Quick Search';
$placeholder = $placeholder ?? 'Search patients, appointments, doctors...';
$currentUser = $this->getRequest()->getAttribute('identity');
?>

<style>
/* Container to match dashboard width */
.search-widget-container {
    max-width: 1680px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
}

.search-widget {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    padding: 28px;
    margin-bottom: 32px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 100%;
    box-sizing: border-box;
}

.search-widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.search-widget::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #0066cc, #22c55e, #0066cc);
    background-size: 200% 100%;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.search-widget-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.search-widget-title {
    font-size: 20px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.search-widget-title i {
    color: #0066cc;
    font-size: 18px;
}

.search-widget-form {
    display: flex;
    gap: 16px;
    align-items: center;
    flex-wrap: wrap;
    width: 100%;
}

.search-widget-input-container {
    flex: 1;
    min-width: 250px;
    max-width: 100%;
    position: relative;
}

.search-widget-input {
    width: 100%;
    padding: 16px 20px 16px 48px;
    font-size: 16px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.2s ease;
    outline: none;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    font-weight: 500;
    color: #1f1f1f;
    box-sizing: border-box;
}

.search-widget-input:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    background: rgba(255, 255, 255, 0.95);
}

.search-widget-input::placeholder {
    color: #666;
}

.search-widget-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
    font-size: 16px;
    pointer-events: none;
}

.search-widget-btn {
    padding: 16px 24px;
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2);
    flex-shrink: 0;
}

.search-widget-btn:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 102, 204, 0.3);
}

.search-widget-btn:active {
    transform: translateY(0);
}

.search-widget-quick-links {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    width: 100%;
}

.search-widget-quick-title {
    font-size: 12px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 12px;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.search-quick-links {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    width: 100%;
}

.search-quick-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: rgba(0, 102, 204, 0.05);
    color: #0066cc;
    text-decoration: none;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: 1px solid rgba(0, 102, 204, 0.1);
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    flex-shrink: 0;
}

.search-quick-link:hover {
    background: rgba(0, 102, 204, 0.1);
    color: #0052a3;
    text-decoration: none;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.search-quick-link i {
    font-size: 11px;
}

.search-quick-link.success {
    background: rgba(34, 197, 94, 0.05);
    color: #22c55e;
    border-color: rgba(34, 197, 94, 0.1);
}

.search-quick-link.success:hover {
    background: rgba(34, 197, 94, 0.1);
    color: #16a34a;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);
}

.search-quick-link.warning {
    background: rgba(245, 158, 11, 0.05);
    color: #f59e0b;
    border-color: rgba(245, 158, 11, 0.1);
}

.search-quick-link.warning:hover {
    background: rgba(245, 158, 11, 0.1);
    color: #d97706;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);
}

.search-quick-link.info {
    background: rgba(6, 182, 212, 0.05);
    color: #06b6d4;
    border-color: rgba(6, 182, 212, 0.1);
}

.search-quick-link.info:hover {
    background: rgba(6, 182, 212, 0.1);
    color: #0891b2;
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.2);
}

/* Bootstrap column integration */
.col-md-10 .search-widget,
.col-lg-10 .search-widget,
.col-xl-10 .search-widget,
.col-md-8 .search-widget,
.col-lg-8 .search-widget {
    margin-left: 0;
    margin-right: 0;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .search-widget-container {
        padding: 0 16px;
    }
    
    .search-widget {
        padding: 20px;
        margin-bottom: 24px;
    }
    
    .search-widget-form {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }
    
    .search-widget-input-container {
        min-width: unset;
        width: 100%;
    }
    
    .search-widget-input {
        padding: 14px 16px 14px 44px;
        font-size: 15px;
    }
    
    .search-widget-icon {
        left: 14px;
        font-size: 15px;
    }
    
    .search-widget-btn {
        width: 100%;
        justify-content: center;
        padding: 14px 20px;
        font-size: 15px;
    }
    
    .search-quick-links {
        justify-content: flex-start;
    }
    
    .search-quick-link {
        padding: 6px 12px;
        font-size: 12px;
    }
}

@media (max-width: 576px) {
    .search-widget {
        padding: 16px;
    }
    
    .search-widget-title {
        font-size: 18px;
    }
    
    .search-widget-input {
        padding: 12px 14px 12px 40px;
        font-size: 14px;
    }
    
    .search-widget-icon {
        left: 12px;
        font-size: 14px;
    }
    
    .search-widget-btn {
        padding: 12px 18px;
        font-size: 14px;
    }
    
    .search-quick-links {
        gap: 8px;
    }
    
    .search-quick-link {
        padding: 4px 8px;
        font-size: 11px;
    }
}

@media (max-width: 400px) {
    .search-widget-input-container {
        min-width: 200px;
    }
    
    .search-widget-form {
        gap: 8px;
    }
}
</style>

<!-- Wrap the widget in the container -->
<div class="search-widget-container">
    <div class="search-widget">
        <div class="search-widget-header">
            <h5 class="search-widget-title">
                <i class="fas fa-search"></i>
                <?= h($title) ?>
            </h5>
        </div>
        
        <?= $this->Form->create(null, [
            'type' => 'get',
            'class' => 'search-widget-form',
            'url' => ['controller' => 'Search', 'action' => 'index']
        ]) ?>
            <div class="search-widget-input-container">
                <i class="fas fa-search search-widget-icon"></i>
                <?= $this->Form->control('q', [
                    'label' => false,
                    'placeholder' => h($placeholder),
                    'class' => 'search-widget-input',
                    'autocomplete' => 'off'
                ]) ?>
            </div>
            <button type="submit" class="search-widget-btn">
                <i class="fas fa-search"></i>
                Search
            </button>
        <?= $this->Form->end() ?>
        
        <?php if ($currentUser): ?>
        <div class="search-widget-quick-links">
            <div class="search-widget-quick-title">Quick Access</div>
            <div class="search-quick-links">
                <?php if ($currentUser->role === 'admin'): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-users"></i> All Patients',
                        ['controller' => 'Patients', 'action' => 'index'],
                        ['class' => 'search-quick-link', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-user-md"></i> All Doctors',
                        ['controller' => 'Doctors', 'action' => 'index'],
                        ['class' => 'search-quick-link success', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-calendar-check"></i> All Appointments',
                        ['controller' => 'Appointments', 'action' => 'index'],
                        ['class' => 'search-quick-link warning', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-building"></i> Departments',
                        ['controller' => 'Departments', 'action' => 'index'],
                        ['class' => 'search-quick-link info', 'escape' => false]
                    ) ?>
                <?php elseif ($currentUser->role === 'doctor'): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-users"></i> My Patients',
                        ['controller' => 'Patients', 'action' => 'index'],
                        ['class' => 'search-quick-link', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-calendar-check"></i> My Appointments',
                        ['controller' => 'Appointments', 'action' => 'index'],
                        ['class' => 'search-quick-link success', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-chart-bar"></i> My Reports',
                        ['controller' => 'Reports', 'action' => 'index'],
                        ['class' => 'search-quick-link warning', 'escape' => false]
                    ) ?>
                <?php elseif ($currentUser->role === 'patient'): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-calendar-check"></i> My Appointments',
                        ['controller' => 'Appointments', 'action' => 'index'],
                        ['class' => 'search-quick-link', 'escape' => false]
                    ) ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-user"></i> My Profile',
                        ['controller' => 'Patients', 'action' => 'view', $currentUser->patient_id ?? 0],
                        ['class' => 'search-quick-link success', 'escape' => false]
                    ) ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>