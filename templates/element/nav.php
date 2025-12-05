<?php

$user = $this->getRequest()->getAttribute('identity');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Hospital System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($user): ?>
                  <?php if ($user->role === 'admin'): ?>
            <li class="nav-item">
                <?= $this->Html->link('Dashboard', ['controller' => 'Appointments', 'action' => 'dashboard'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('Departments', ['controller' => 'Departments', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('Schedules', ['controller' => 'DoctorSchedules', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>

        <?php elseif ($user->role === 'doctor'): ?>
            <li class="nav-item">
                <?= $this->Html->link('Dashboard', ['controller' => 'Doctors', 'action' => 'dashboard'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('My Appointments', ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('My Schedule', ['controller' => 'DoctorSchedules', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('Patients', ['controller' => 'Patients', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
          <?php elseif ($user->role === 'patient'): ?>
            <li class="nav-item">
              <?= $this->Html->link('Dashboard', ['controller' => 'Patients', 'action' => 'dashboard'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
              <?= $this->Html->link('My Appointments', ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item">
              <?= $this->Html->link('Doctors', ['controller' => 'Doctors', 'action' => 'index'], ['class' => 'nav-link']) ?>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <?php if ($user): ?>
          <li class="nav-item">
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
