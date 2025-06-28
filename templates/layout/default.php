<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Hospital Appointment System
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
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 56px; /* Height of navbar */
            bottom: 0;
            left: 0;
            z-index: 100;
            width: 240px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            overflow-y: auto;
        }
        .sidebar-sticky {
            padding-top: 1rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .main-content {
            margin-left: 240px;
            margin-top: 0; /* Remove extra space below topbar */
            padding: 20px 20px 20px 20px;
            min-height: calc(100vh - 56px);
        }
        
        /* For login page when no sidebar is needed */
        .no-sidebar {
            margin-left: 0 !important;
        }
        
        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 1050;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
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
            $isHome = $this->getRequest()->getParam('controller') === 'Pages' && $this->getRequest()->getParam('action') === 'home';
            if ($identity && !$isHome):
                $currentUser = $identity;
                $userRole = $currentUser->role;
            ?>
            <nav id="sidebarMenu" class="sidebar collapse d-md-block">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <?php if ($userRole === 'admin'): ?>
                            <!-- Admin Navigation -->
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-chart-area"></i> Dashboard', 
                                    ['controller' => 'Appointments', 'action' => 'dashboard'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-calendar-check"></i> Appointments', 
                                    ['controller' => 'Appointments', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-users"></i> Patients', 
                                    ['controller' => 'Patients', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-user-md"></i> Doctors', 
                                    ['controller' => 'Doctors', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-building"></i> Departments', 
                                    ['controller' => 'Departments', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-cog"></i> Users', 
                                    ['controller' => 'Users', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                        
                        <?php elseif ($userRole === 'doctor'): ?>
                            <!-- Doctor Navigation -->
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-chart-area"></i> My Dashboard', 
                                    ['controller' => 'Doctors', 'action' => 'dashboard'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-chart-bar"></i> My Reports', 
                                    ['controller' => 'Reports', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-calendar-check"></i> My Appointments', 
                                    ['controller' => 'Appointments', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-users"></i> Patients', 
                                    ['controller' => 'Patients', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-user-md"></i> My Profile', 
                                    ['controller' => 'Doctors', 'action' => 'view', $currentUser->id], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                        
                        <?php elseif ($userRole === 'patient'): ?>
                            <!-- Patient Navigation -->
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-chart-area"></i> My Dashboard', 
                                    ['controller' => 'Patients', 'action' => 'dashboard'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-calendar-check"></i> My Appointments', 
                                    ['controller' => 'Appointments', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-user"></i> My Profile', 
                                    ['controller' => 'Patients', 'action' => 'view', $currentUser->id], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                        
                        <?php elseif ($userRole === 'staff'): ?>
                            <!-- Staff Navigation -->
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-chart-area"></i> Dashboard', 
                                    ['controller' => 'Appointments', 'action' => 'dashboard'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-calendar-check"></i> Appointments', 
                                    ['controller' => 'Appointments', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-users"></i> Patients', 
                                    ['controller' => 'Patients', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                            <li class="nav-item">
                                <?= $this->Html->link('<i class="fas fa-user-md"></i> Doctors', 
                                    ['controller' => 'Doctors', 'action' => 'index'], 
                                    ['class' => 'nav-link', 'escape' => false]) ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            <?php endif; ?>

            <!-- Main content -->
            <main class="<?= $this->getRequest()->getAttribute('identity') ? 'main-content' : 'no-sidebar' ?>" style="margin-top: 56px;">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->fetch('script') ?>
    <?= $this->element('footer') ?>
</body>
</html>