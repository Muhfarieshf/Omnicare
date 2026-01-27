<footer class="bg-white border-top py-5 mt-auto">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <?= $this->Html->link(
                    '<div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2"><i class="fas fa-hospital text-primary fa-lg"></i></div><span class="fs-4 fw-bold text-primary">OmniCare</span>',
                    '/',
                    ['class' => 'd-flex align-items-center mb-3 text-dark text-decoration-none', 'escape' => false]
                ) ?>
                <p class="text-muted small">
                    Providing advanced healthcare solutions with a patient-centric approach. Your health is our
                    priority.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-secondary hover-primary"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-secondary hover-primary"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-secondary hover-primary"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-secondary hover-primary"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="fw-bold mb-3">Links</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <?= $this->Html->link('Home', '/', ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                    <li class="mb-2">
                        <?= $this->Html->link('About Us', ['controller' => 'Pages', 'action' => 'display', 'about'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                    <li class="mb-2">
                        <?= $this->Html->link('Services', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                    <li class="mb-2">
                        <?= $this->Html->link('Contact', ['controller' => 'Pages', 'action' => 'display', 'contact'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                </ul>
            </div>

            <div class="col-6 col-lg-2">
                <h6 class="fw-bold mb-3">Services</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <?= $this->Html->link('General Care', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                    <li class="mb-2">
                        <?= $this->Html->link('Pediatrics', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                    <li class="mb-2">
                        <?= $this->Html->link('Cardiology', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                    <li class="mb-2">
                        <?= $this->Html->link('Emergency', ['controller' => 'Pages', 'action' => 'display', 'contact'], ['class' => 'text-decoration-none text-muted hover-dark']) ?>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6 class="fw-bold mb-3">Newsletter</h6>
                <p class="small text-muted">Subscribe to our newsletter for health tips and updates.</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control form-control-sm" placeholder="Email address">
                    <button class="btn btn-primary btn-sm" type="button">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="border-top pt-4 mt-4 text-center small text-muted">
            <p class="mb-0">&copy; <?= date('Y') ?> OmniCare Health System. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    .hover-primary:hover {
        color: #0078d4 !important;
    }

    .hover-dark:hover {
        color: #000 !important;
    }
</style>