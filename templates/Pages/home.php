<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height:80vh; max-width:1680px;">
    <div class="text-center">
        <h1 class="display-3 fw-bold mb-3">Welcome to OmniCare</h1>
        <p class="lead mb-4">(Online Medical Network for Integrated Clinical Appointment Reservations)<p>
        <div class="mb-4">
            <img src="/webroot/img/omnicare-hero.png" alt="OmniCare" style="max-width:320px;" class="mb-3"/>
        </div>
        <div class="d-flex justify-content-center gap-3">
            <?= $this->Html->link('Book Appointment', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>
</div>
