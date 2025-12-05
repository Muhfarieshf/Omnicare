<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        OmniCare
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <?= $this->Html->css(['cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f8f9fa;
            color: #1f1f1f;
            max-width: 100vw;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1050;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            width: 260px;
            height: calc(100vh - 64px);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-sticky {
            padding: 20px 0;
        }

        /* Navigation */
        .nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #666;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(0, 102, 204, 0.1);
            color: #0066cc;
            border-left-color: #0066cc;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* Menu sections */
        .menu-section {
            margin: 20px 0 0 0;
        }

        .menu-section-title {
            padding: 8px 24px;
            font-size: 12px;
            font-weight: 600;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            margin-top: 64px;
            padding: 24px;
            min-height: calc(100vh - 64px);
        }

        .no-sidebar {
            margin-left: 0 !important;
        }

        /* Flash messages - Modern styling */
        .flash-overlay {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            min-width: 320px;
            max-width: 90vw;
            z-index: 1040;
            background: rgba(255,255,255,0.95);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(16px);
            padding: 16px 20px;
            animation: slideInFlash 0.3s ease-out;
        }

        .flash-overlay .alert {
            background: transparent !important;
            border: none !important;
            margin: 0;
            padding: 0;
            color: inherit;
            box-shadow: none;
        }

        .flash-overlay.alert-success { 
            border-left: 4px solid #22c55e;
            color: #16a34a;
        }
        .flash-overlay.alert-danger { 
            border-left: 4px solid #e11d48;
            color: #dc2626;
        }
        .flash-overlay.alert-info { 
            border-left: 4px solid #0066cc;
            color: #0066cc;
        }
        .flash-overlay.alert-warning { 
            border-left: 4px solid #f59e0b;
            color: #d97706;
        }

        @keyframes slideInFlash {
            from { 
                opacity: 0; 
                transform: translateX(-50%) translateY(-20px) scale(0.95); 
            }
            to { 
                opacity: 1; 
                transform: translateX(-50%) translateY(0) scale(1); 
            }
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 16px;
            }
            
            .topbar {
                padding: 0 16px;
            }
        }

        /* Mobile menu toggle */
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

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 64px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Content wrapper */
        .content-wrapper {
            background: #f8f9fa;
            min-height: 100vh;
        }

        /* Override Bootstrap classes for consistency */
        .container-fluid {
            padding: 0;
            margin: 0;
            max-width: none;
        }

        .row {
            margin: 0;
        }

        /* Hide scrollbars but keep functionality */
        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }

        /* Enhanced active state detection */
        .nav-link.current-page {
            background: rgba(0, 102, 204, 0.1);
            color: #0066cc;
            border-left-color: #0066cc;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <?php
        // Determine if the current page is the homepage
        $isHome = $this->getRequest()->getParam('controller') === 'Pages' && $this->getRequest()->getParam('action') === 'home';
        if ($isHome) {
            echo $this->element('topbar_home');
        } else {
            echo $this->element('topbar');
        }
        ?>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <?php
                // Only show sidebar if authenticated and NOT on the homepage
                $identity = $this->getRequest()->getAttribute('identity');
                if ($identity && !$isHome):
                    $currentUser = $identity;
                    $userRole = $currentUser->role;
                    
                    // Get current controller and action for active state
                    $currentController = $this->getRequest()->getParam('controller');
                    $currentAction = $this->getRequest()->getParam('action');
                ?>
                
                <!-- Mobile overlay -->
                <div class="sidebar-overlay" id="sidebarOverlay"></div>
                
                <nav id="sidebarMenu" class="sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <?php if ($userRole === 'admin'): ?>
                                <!-- Admin Navigation -->
                                <div class="menu-section-title">Management</div>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-chart-area"></i> Dashboard', 
                                        ['controller' => 'Appointments', 'action' => 'dashboard'], 
                                        ['class' => 'nav-link' . ($currentController === 'Appointments' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-calendar-check"></i> Appointments', 
                                        ['controller' => 'Appointments', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Appointments' && $currentAction === 'index' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-users"></i> Patients', 
                                        ['controller' => 'Patients', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Patients' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-user-md"></i> Doctors', 
                                        ['controller' => 'Doctors', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Doctors' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-clock"></i> Schedules', 
                                        ['controller' => 'DoctorSchedules', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'DoctorSchedules' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-building"></i> Departments', 
                                        ['controller' => 'Departments', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Departments' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>

                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-hourglass-half"></i> Waiting List', 
                                        ['controller' => 'WaitingList', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'WaitingList' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                
                                <div class="menu-section">
                                    <div class="menu-section-title">System</div>
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fas fa-cog"></i> Users', 
                                            ['controller' => 'Users', 'action' => 'index'], 
                                            ['class' => 'nav-link' . ($currentController === 'Users' ? ' current-page' : ''), 'escape' => false]) ?>
                                    </li>
                                </div>
                            
                            <?php elseif ($userRole === 'doctor'): ?>
                                <!-- Doctor Navigation -->
                                <div class="menu-section-title">Overview</div>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-chart-area"></i> My Dashboard', 
                                        ['controller' => 'Doctors', 'action' => 'dashboard'], 
                                        ['class' => 'nav-link' . ($currentController === 'Doctors' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-chart-bar"></i> My Reports', 
                                        ['controller' => 'Reports', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Reports' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                
                                <div class="menu-section">
                                    <div class="menu-section-title">Management</div>
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fas fa-calendar-check"></i> My Appointments', 
                                            ['controller' => 'Appointments', 'action' => 'index'], 
                                            ['class' => 'nav-link' . ($currentController === 'Appointments' ? ' current-page' : ''), 'escape' => false]) ?>
                                    </li>

                                    <li class="nav-item">
                                         <?= $this->Html->link('<i class="fas fa-clock"></i> My Schedule', 
                                             ['controller' => 'DoctorSchedules', 'action' => 'index'], 
                                            ['class' => 'nav-link' . ($currentController === 'DoctorSchedules' ? ' current-page' : ''), 'escape' => false]) ?>
                                  </li>

                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fas fa-users"></i> Patients', 
                                            ['controller' => 'Patients', 'action' => 'index'], 
                                            ['class' => 'nav-link' . ($currentController === 'Patients' ? ' current-page' : ''), 'escape' => false]) ?>
                                    </li>

                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fas fa-hourglass-half"></i> Waiting List', 
                                            ['controller' => 'WaitingList', 'action' => 'index'], 
                                            ['class' => 'nav-link' . ($currentController === 'WaitingList' ? ' current-page' : ''), 'escape' => false]) ?>
                                    </li>

                                </div>
                                
                                <div class="menu-section">
                                    <div class="menu-section-title">Profile</div>
                                    <li class="nav-item">
                                        <?= $this->Html->link('<i class="fas fa-user-md"></i> My Profile', 
                                            ['controller' => 'Doctors', 'action' => 'view', $currentUser->doctor_id], 
                                            ['class' => 'nav-link' . ($currentController === 'Doctors' && $currentAction === 'view' ? ' current-page' : ''), 'escape' => false]) ?>
                                    </li>
                                </div>
                            
                            <?php elseif ($userRole === 'patient'): ?>
                                <!-- Patient Navigation -->
                                <div class="menu-section-title">My Health</div>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-chart-area"></i> My Dashboard', 
                                        ['controller' => 'Patients', 'action' => 'dashboard'], 
                                        ['class' => 'nav-link' . ($currentController === 'Patients' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-calendar-check"></i> My Appointments', 
                                        ['controller' => 'Appointments', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Appointments' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-user"></i> My Profile', 
                                        ['controller' => 'Patients', 'action' => 'view', $currentUser->id], 
                                        ['class' => 'nav-link' . ($currentController === 'Patients' && $currentAction === 'view' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>

                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-clock"></i> Waiting List', 
                                        ['controller' => 'WaitingList', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'WaitingList' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                            
                            <?php elseif ($userRole === 'staff'): ?>
                                <!-- Staff Navigation -->
                                <div class="menu-section-title">Management</div>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-chart-area"></i> Dashboard', 
                                        ['controller' => 'Appointments', 'action' => 'dashboard'], 
                                        ['class' => 'nav-link' . ($currentController === 'Appointments' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-calendar-check"></i> Appointments', 
                                        ['controller' => 'Appointments', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Appointments' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-users"></i> Patients', 
                                        ['controller' => 'Patients', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Patients' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('<i class="fas fa-user-md"></i> Doctors', 
                                        ['controller' => 'Doctors', 'action' => 'index'], 
                                        ['class' => 'nav-link' . ($currentController === 'Doctors' ? ' current-page' : ''), 'escape' => false]) ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
                <?php endif; ?>

                <!-- Main content -->
                <main class="<?= $identity && !$isHome ? 'main-content' : 'no-sidebar' ?>">
                    <!-- Enhanced flash messages -->
                    <?php $flashContent = $this->Flash->render(); ?>
                    <?php if (!empty(trim($flashContent))): ?>
                        <div class="flash-overlay" id="flashOverlay">
                            <?= $flashContent ?>
                        </div>
                    <?php endif; ?>
                    
                    <?= $this->fetch('content') ?>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.getElementById('sidebarMenu');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });
                
                // Close sidebar when clicking overlay
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
            
            // Auto-hide flash messages
            const flash = document.getElementById('flashOverlay');
            if (flash && flash.innerText.trim() !== '') {
                setTimeout(() => {
                    flash.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateX(-50%) translateY(-20px) scale(0.95)';
                    setTimeout(() => flash.style.display = 'none', 500);
                }, 4000);
            }
        });
    </script>
    
    <?= $this->fetch('script') ?>
    <?= $this->element('footer') ?>
</body>
</html>