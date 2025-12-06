<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $results
 * @var string $query
 */
?>

<div class="list-container">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-search"></i>
            Search Results
        </h3>
        <div class="text-muted">
            Found <?= count($results) ?> match(es) for "<strong><?= h($query) ?></strong>"
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= $this->Url->build(['action' => 'index']) ?>" method="get" class="d-flex gap-2">
                        <input type="text" name="q" class="form-control form-control-lg" value="<?= h($query) ?>" placeholder="Search patients, doctors, appointments...">
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <?php if (!empty($results)): ?>
                <div class="d-flex flex-column gap-3">
                    <?php foreach ($results as $result): ?>
                        <div class="card mb-0 hover-shadow transition-all">
                            <div class="card-body d-flex align-items-center p-3">
                                <?php
                                $icon = 'fa-file';
                                $colorClass = 'bg-secondary';
                                $typeLabel = 'Result';
                                $link = '#';

                                // Determine type styles
                                if (isset($result['type'])) {
                                    switch($result['type']) {
                                        case 'patient':
                                            $icon = 'fa-user-injured';
                                            $colorClass = 'bg-primary'; // Blue
                                            $typeLabel = 'Patient';
                                            $link = ['controller' => 'Patients', 'action' => 'view', $result['id']];
                                            break;
                                        case 'doctor':
                                            $icon = 'fa-user-md';
                                            $colorClass = 'bg-success'; // Green
                                            $typeLabel = 'Doctor';
                                            $link = ['controller' => 'Doctors', 'action' => 'view', $result['id']];
                                            break;
                                        case 'appointment':
                                            $icon = 'fa-calendar-check';
                                            $colorClass = 'bg-warning text-dark'; // Yellow
                                            $typeLabel = 'Appointment';
                                            $link = ['controller' => 'Appointments', 'action' => 'view', $result['id']];
                                            break;
                                    }
                                }
                                ?>
                                
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 text-white <?= $colorClass ?>" style="width: 48px; height: 48px;">
                                    <i class="fas <?= $icon ?>"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 card-title" style="font-size: 1.1rem;">
                                            <?= $this->Html->link($result['title'], $link, ['class' => 'text-decoration-none text-dark stretched-link']) ?>
                                        </h5>
                                        <span class="badge <?= $colorClass ?> bg-opacity-75 rounded-pill small"><?= $typeLabel ?></span>
                                    </div>
                                    <p class="mb-0 text-muted small">
                                        <?= h($result['subtitle'] ?? '') ?>
                                    </p>
                                </div>
                                
                                <div class="ms-3 text-muted">
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif (!empty($query)): ?>
                <div class="empty-state">
                    <i class="fas fa-search text-muted mb-3" style="font-size: 48px;"></i>
                    <h5>No matches found</h5>
                    <p class="text-muted">Try adjusting your search terms or check for typos.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>