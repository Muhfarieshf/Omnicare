<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OmniCare - <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?= $this->Html->css(['modern-dashboard']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?php
    $isHome = $this->getRequest()->getParam('controller') === 'Pages' && $this->getRequest()->getParam('action') === 'home';
    if ($isHome) {
        echo $this->element('topbar_home');
    } else {
        echo $this->element('topbar');
    }
    ?>

    <?php
    $identity = $this->getRequest()->getAttribute('identity');
    if ($identity && !$isHome) {
        echo $this->element('sidebar');
    }
    ?>

    <main class="<?= ($identity && !$isHome) ? 'main-content' : 'no-sidebar' ?>">
        <div class="flash-container">
            <?= $this->Flash->render() ?>
        </div>
        
        <?= $this->fetch('content') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Sidebar Toggle
            const toggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebarMenu');
            const overlay = document.getElementById('sidebarOverlay');

            if(toggle && sidebar) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('show');
                    if(overlay) overlay.classList.toggle('show');
                });

                if(overlay) {
                    overlay.addEventListener('click', function() {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                    });
                }
            }
            
            // Auto-hide Flash Messages
            const flash = document.querySelector('.message');
            if(flash) {
                setTimeout(() => {
                    flash.style.opacity = '0';
                    setTimeout(() => flash.remove(), 500);
                }, 4000);
            }
        });
    </script>
</body>
</html>