<?php
// templates/element/topbar_home.php
$controller = $this->getRequest()->getParam('controller');
$action = $this->getRequest()->getParam('action');
$pass = $this->getRequest()->getParam('pass');
$currentSlug = $pass[0] ?? '';

$isActive = function ($ctrl, $act = null, $slug = null) use ($controller, $action, $currentSlug) {
    if ($controller !== $ctrl)
        return '';
    if ($act && $action !== $act)
        return '';
    if ($slug && $currentSlug !== $slug)
        return '';
    return 'active fw-bold text-primary';
};
?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white bg-opacity-95 shadow-sm backdrop-blur"
    style="height: 80px; transition: all 0.3s;">
    <div class="container">
        <!-- Brand -->
        <?= $this->Html->link(
            '<div class="bg-primary bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fas fa-hospital text-primary"></i></div><span class="fw-bold fs-4 text-dark ls-1">OmniCare</span>',
            '/',
            ['class' => 'navbar-brand d-flex align-items-center gap-2', 'escape' => false]
        ) ?>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Centered Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-4">
                <li class="nav-item">
                    <?= $this->Html->link('Home', '/', ['class' => 'nav-link ' . ($controller === 'Pages' && $action === 'home' ? 'active fw-bold text-primary' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('About Us', ['controller' => 'Pages', 'action' => 'display', 'about'], ['class' => 'nav-link ' . ($currentSlug === 'about' ? 'active fw-bold text-primary' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Services', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'nav-link ' . ($currentSlug === 'services' ? 'active fw-bold text-primary' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Our Doctors', ['controller' => 'Pages', 'action' => 'doctors'], ['class' => 'nav-link ' . ($action === 'doctors' ? 'active fw-bold text-primary' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Contact', ['controller' => 'Pages', 'action' => 'display', 'contact'], ['class' => 'nav-link ' . ($currentSlug === 'contact' ? 'active fw-bold text-primary' : '')]) ?>
                </li>
            </ul>

            <!-- Right Actions -->
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <?php if ($this->getRequest()->getAttribute('identity')): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-columns me-2"></i>Dashboard',
                        '/users/dashboard',
                        ['class' => 'btn btn-outline-primary rounded-pill px-4 fw-bold', 'escape' => false]
                    ) ?>
                <?php else: ?>
                    <?= $this->Html->link(
                        'Login',
                        ['controller' => 'Users', 'action' => 'login'],
                        ['class' => 'text-decoration-none fw-bold text-dark hover-primary me-2']
                    ) ?>
                    <?= $this->Html->link(
                        'Book Now',
                        ['controller' => 'Appointments', 'action' => 'add'],
                        ['class' => 'btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm hover-lift']
                    ) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<style>
    .backdrop-blur {
        backdrop-filter: blur(10px);
    }

    .nav-link {
        color: #555;
        font-weight: 500;
        font-size: 0.95rem;
        position: relative;
    }

    .nav-link:hover {
        color: #0078d4;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background-color: #0078d4;
        transition: width 0.3s ease;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    .hover-primary:hover {
        color: #0078d4 !important;
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }
</style>