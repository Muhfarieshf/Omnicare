<?php
$currentController = $this->getRequest()->getParam('controller');
$currentAction = $this->getRequest()->getParam('action');
$user = $this->getRequest()->getAttribute('identity');
$role = $user->role ?? 'guest';
?>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<nav id="sidebarMenu" class="sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            
            <?php if ($role === 'admin'): ?>
                <div class="menu-section-title">Overview</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-chart-pie"></i> Dashboard', 
                        ['controller' => 'Appointments', 'action' => 'dashboard'], 
                        ['class' => 'nav-link' . ($currentController === 'Appointments' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>

                <div class="menu-section-title">Management</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-calendar-alt"></i> Appointments', 
                        ['controller' => 'Appointments', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Appointments' && $currentAction === 'index' ? ' current-page' : ''), 'escape' => false]) ?>
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
                    <?= $this->Html->link('<i class="fas fa-hourglass-half"></i> Waiting List', 
                        ['controller' => 'WaitingList', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'WaitingList' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-building"></i> Departments', 
                        ['controller' => 'Departments', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Departments' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>

                <div class="menu-section-title">System</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-users-cog"></i> Users', 
                        ['controller' => 'Users', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Users' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>

            <?php elseif ($role === 'doctor'): ?>
                <div class="menu-section-title">Overview</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-chart-line"></i> Dashboard', 
                        ['controller' => 'Doctors', 'action' => 'dashboard'], 
                        ['class' => 'nav-link' . ($currentController === 'Doctors' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-chart-bar"></i> My Reports', 
                        ['controller' => 'Reports', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Reports' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>

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
                    <?= $this->Html->link('<i class="fas fa-hourglass-half"></i> Waiting List', 
                        ['controller' => 'WaitingList', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'WaitingList' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-users"></i> My Patients', 
                        ['controller' => 'Patients', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Patients' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <div class="menu-section-title">Account</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-user-md"></i> My Profile', 
                        ['controller' => 'Doctors', 'action' => 'view', $user->doctor_id], 
                        ['class' => 'nav-link' . ($currentController === 'Doctors' && $currentAction === 'view' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>

            <?php elseif ($role === 'patient'): ?>
                <div class="menu-section-title">My Health</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-heartbeat"></i> Dashboard', 
                        ['controller' => 'Patients', 'action' => 'dashboard'], 
                        ['class' => 'nav-link' . ($currentController === 'Patients' && $currentAction === 'dashboard' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-calendar-alt"></i> My Appointments', 
                        ['controller' => 'Appointments', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Appointments' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-list-ol"></i> Waiting List', 
                        ['controller' => 'WaitingList', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'WaitingList' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-user-md"></i> Find Doctors', 
                        ['controller' => 'Doctors', 'action' => 'index'], 
                        ['class' => 'nav-link' . ($currentController === 'Doctors' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
                <div class="menu-section-title">Account</div>
                <li class="nav-item">
                    <?= $this->Html->link('<i class="fas fa-user"></i> My Profile', 
                        ['controller' => 'Patients', 'action' => 'view', $user->patient_id], 
                        ['class' => 'nav-link' . ($currentController === 'Patients' && $currentAction === 'view' ? ' current-page' : ''), 'escape' => false]) ?>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>