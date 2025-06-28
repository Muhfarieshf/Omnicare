<?php
// templates/element/topbar.php
$user = $this->getRequest()->getAttribute('identity');
$displayName = null;
if ($user) {
    if ($user->role === 'admin') {
        $displayName = $user->username;
    } elseif (property_exists($user, 'patient_id') && $user->patient_id && property_exists($user, 'patient') && !empty($user->patient->name)) {
        $displayName = $user->patient->name;
    } elseif (property_exists($user, 'doctor_id') && $user->doctor_id && property_exists($user, 'doctor') && !empty($user->doctor->name)) {
        $displayName = $user->doctor->name;
    } elseif (property_exists($user, 'name') && !empty($user->name)) {
        $displayName = $user->name;
    } else {
        $displayName = $user->username;
    }
}
?>
<div class="topbar bg-white border-bottom" style="height:56px; position:fixed; top:0; left:0; right:0; z-index:1040;">
    <div class="d-flex justify-content-between align-items-center px-3 py-2 mx-auto" style="max-width:1680px;">
        <div class="d-flex align-items-center">
            <?php if (!$user): ?>
                <?= $this->Html->link(
                    '<span class="fw-bold fs-5">🏥 OmniCare</span>',
                    ['controller' => 'Pages', 'action' => 'home'],
                    ['escape' => false, 'class' => 'text-decoration-none text-dark']
                ) ?>
            <?php else: ?>
                <span class="fw-bold fs-5">🏥 OmniCare</span>
            <?php endif; ?>
        </div>
        <div class="d-flex align-items-center">
            <?php if ($user): ?>
                <span class="me-3">Welcome, <strong><?= h($displayName) ?></strong></span>
                <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-outline-danger btn-sm']) ?>
            <?php else: ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>
