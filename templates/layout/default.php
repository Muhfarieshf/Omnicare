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
            margin-top: 56px; /* Height of navbar */
            padding: 20px;
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
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <?= $this->Html->link('Hospital Appointment System', ['controller' => 'Appointments', 'action' => 'dashboard'], ['class' => 'navbar-brand']) ?>
            
            <!-- Mobile sidebar toggle -->
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="navbar-nav ms-auto">
                <?php if ($this->getRequest()->getAttribute('identity')): 
                    $currentUser = $this->getRequest()->getAttribute('identity');
                ?>
                    <span class="navbar-text me-3">
                        Welcome, <?= h($currentUser->username) ?>
                        <span class="badge bg-light text-dark ms-1"><?= ucfirst($currentUser->role) ?></span>
                    </span>
                    <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-outline-light btn-sm']) ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php if ($this->getRequest()->getAttribute('identity')): 
                $currentUser = $this->getRequest()->getAttribute('identity');
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
            <main class="<?= $this->getRequest()->getAttribute('identity') ? 'main-content' : 'no-sidebar' ?>">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->fetch('script') ?>
</body>
</html>