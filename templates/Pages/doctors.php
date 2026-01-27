<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department[] $departments
 */
$this->assign('title', 'Our Doctors');

// Define department icons and colors for visual consistency
$deptStyles = [
    'Cardiology' => ['icon' => 'fa-heartbeat', 'color' => 'danger'],
    'Neurology' => ['icon' => 'fa-brain', 'color' => 'secondary'],
    'Pediatrics' => ['icon' => 'fa-baby', 'color' => 'warning'],
    'Orthopedics' => ['icon' => 'fa-bone', 'color' => 'info'],
    'General Medicine' => ['icon' => 'fa-stethoscope', 'color' => 'primary'],
    'Dental Care' => ['icon' => 'fa-tooth', 'color' => 'success'],
    'Dermatology' => ['icon' => 'fa-hand-sparkles', 'color' => 'pink'],
    'Ophthalmology' => ['icon' => 'fa-eye', 'color' => 'purple'],
    'ENT' => ['icon' => 'fa-ear-listen', 'color' => 'teal'],
    'Psychiatry' => ['icon' => 'fa-head-side-brain', 'color' => 'indigo'],
];
$defaultStyle = ['icon' => 'fa-user-md', 'color' => 'primary'];
?>

<div class="doctors-page" style="overflow-x: hidden;">
    <!-- Hero Section -->
    <section class="position-relative py-5 bg-gradient-primary-soft">
        <!-- Background Decorations -->
        <div class="position-absolute top-0 end-0 mt-n5 me-n5 opacity-10">
            <svg width="400" height="400" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#0078d4"
                    d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.6,9.3,82.4,22.9,71.1,34.3C59.8,45.7,48.4,54.9,36.2,62.3C24,69.7,11,75.3,-1.3,77.6C-13.6,79.9,-28.4,78.9,-41.2,72.4C-54,65.9,-64.8,53.9,-73.4,40.3C-82,26.7,-88.4,11.5,-86.9,-3.1C-85.4,-17.7,-76.1,-31.7,-64.9,-42.6C-53.7,-53.5,-40.6,-61.3,-27.2,-68.8C-13.8,-76.3,-0.1,-83.5,14.7,-85.4L44.7,-76.4Z"
                    transform="translate(100 100)" />
            </svg>
        </div>

        <div class="container py-5 position-relative z-index-1 text-center">
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm mb-3 fw-bold ls-1">
                <i class="fas fa-user-md me-2"></i> EXPERT TEAM
            </span>
            <h1 class="display-3 fw-bold mb-4 text-dark">Meet Our <span class="text-primary">Doctors</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Our team of experienced healthcare professionals is dedicated to providing you with the highest quality care across all specialties.
            </p>
        </div>
    </section>

    <!-- Quick Department Filter -->
    <section class="py-4 bg-white border-bottom sticky-top" style="top: 80px; z-index: 100;">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="#all" class="btn btn-primary rounded-pill px-4 btn-sm dept-filter active" data-dept="all">
                    <i class="fas fa-th-large me-1"></i> All Departments
                </a>
                <?php foreach ($departments as $dept): ?>
                    <?php $style = $deptStyles[$dept->name] ?? $defaultStyle; ?>
                    <a href="#dept-<?= $dept->id ?>" class="btn btn-outline-<?= $style['color'] ?> rounded-pill px-3 btn-sm dept-filter" data-dept="<?= $dept->id ?>">
                        <i class="fas <?= $style['icon'] ?> me-1"></i> <?= h($dept->name) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Doctors by Department -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <?php foreach ($departments as $dept): ?>
                <?php 
                $style = $deptStyles[$dept->name] ?? $defaultStyle;
                $doctorCount = count($dept->doctors ?? []);
                if ($doctorCount === 0) continue;
                ?>
                
                <div class="department-section mb-5" id="dept-<?= $dept->id ?>" data-dept-id="<?= $dept->id ?>">
                    <!-- Department Header -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-<?= $style['color'] ?> bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 50px; height: 50px;">
                            <i class="fas <?= $style['icon'] ?> text-<?= $style['color'] ?> fa-lg"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0"><?= h($dept->name) ?></h3>
                            <small class="text-muted"><?= $doctorCount ?> Doctor<?= $doctorCount > 1 ? 's' : '' ?> Available</small>
                        </div>
                    </div>

                    <!-- Doctors Grid -->
                    <div class="row g-4">
                        <?php foreach ($dept->doctors as $doctor): ?>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card border-0 rounded-4 shadow-sm h-100 hover-lift overflow-hidden">
                                    <!-- Doctor Avatar -->
                                    <div class="position-relative">
                                        <div class="bg-gradient-<?= $style['color'] ?> p-4 text-center" style="background: linear-gradient(135deg, var(--bs-<?= $style['color'] ?>) 0%, var(--bs-<?= $style['color'] ?>-rgb, rgba(0,0,0,0.2)) 100%);">
                                            <div class="bg-white rounded-circle mx-auto d-flex align-items-center justify-content-center shadow"
                                                style="width: 100px; height: 100px;">
                                                <?php if (!empty($doctor->photo)): ?>
                                                    <img src="<?= h($doctor->photo) ?>" alt="<?= h($doctor->name) ?>" class="rounded-circle" style="width: 96px; height: 96px; object-fit: cover;">
                                                <?php else: ?>
                                                    <i class="fas fa-user-md fa-3x text-<?= $style['color'] ?>"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- Status Badge -->
                                        <span class="position-absolute top-0 end-0 m-3 badge bg-success rounded-pill">
                                            <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i> Available
                                        </span>
                                    </div>

                                    <!-- Doctor Info -->
                                    <div class="card-body text-center p-4">
                                        <h5 class="fw-bold mb-1"><?= h($doctor->name) ?></h5>
                                        <p class="text-<?= $style['color'] ?> small mb-3">
                                            <i class="fas <?= $style['icon'] ?> me-1"></i> <?= h($dept->name) ?>
                                        </p>
                                        
                                        <?php if (!empty($doctor->specialization)): ?>
                                            <p class="text-muted small mb-3"><?= h($doctor->specialization) ?></p>
                                        <?php endif; ?>

                                        <!-- Quick Stats -->
                                        <div class="d-flex justify-content-center gap-3 mb-3 small text-muted">
                                            <span><i class="fas fa-star text-warning me-1"></i> 4.9</span>
                                            <span><i class="fas fa-calendar-check text-success me-1"></i> 500+</span>
                                        </div>

                                        <!-- Action Button -->
                                        <?= $this->Html->link(
                                            '<i class="fas fa-calendar-plus me-2"></i>Book Appointment',
                                            ['controller' => 'Users', 'action' => 'login'],
                                            ['class' => 'btn btn-' . $style['color'] . ' btn-sm rounded-pill w-100', 'escape' => false]
                                        ) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($departments) || array_sum(array_map(fn($d) => count($d->doctors ?? []), $departments)) === 0): ?>
                <div class="text-center py-5">
                    <i class="fas fa-user-md fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No doctors available at the moment</h4>
                    <p class="text-muted">Please check back later or contact us for more information.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container py-4 text-center">
            <h2 class="fw-bold mb-3">Ready to Meet Your Doctor?</h2>
            <p class="lead opacity-75 mb-4">Book an appointment today and take the first step towards better health.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <?= $this->Html->link(
                    '<i class="fas fa-calendar-plus me-2"></i>Book Appointment',
                    ['controller' => 'Users', 'action' => 'login'],
                    ['class' => 'btn btn-light btn-lg rounded-pill px-5 fw-bold', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-phone me-2"></i>Call Us',
                    'tel:+1234567890',
                    ['class' => 'btn btn-outline-light btn-lg rounded-pill px-5', 'escape' => false]
                ) ?>
            </div>
        </div>
    </section>
</div>

<style>
.bg-gradient-primary-soft {
    background: linear-gradient(180deg, #f0f8ff, #ffffff);
}

.hover-lift {
    transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 1.5rem 3rem rgba(0, 0, 0, .12) !important;
}

.ls-1 {
    letter-spacing: 1px;
}

.dept-filter {
    transition: all 0.2s;
}

.dept-filter.active {
    transform: scale(1.05);
}

/* Custom gradient backgrounds for department headers */
.bg-gradient-danger { background: linear-gradient(135deg, #dc3545 0%, #ff6b7a 100%); }
.bg-gradient-warning { background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%); }
.bg-gradient-info { background: linear-gradient(135deg, #0dcaf0 0%, #6edff6 100%); }
.bg-gradient-success { background: linear-gradient(135deg, #198754 0%, #4dd4ac 100%); }
.bg-gradient-primary { background: linear-gradient(135deg, #0078d4 0%, #40a9ff 100%); }
.bg-gradient-secondary { background: linear-gradient(135deg, #6c757d 0%, #adb5bd 100%); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Department filter functionality
    const filters = document.querySelectorAll('.dept-filter');
    const sections = document.querySelectorAll('.department-section');
    
    filters.forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            const deptId = this.dataset.dept;
            
            // Update active state
            filters.forEach(f => f.classList.remove('active', 'btn-primary'));
            filters.forEach(f => {
                if (!f.classList.contains('btn-primary')) {
                    f.classList.add('btn-outline-' + (f.dataset.color || 'primary'));
                }
            });
            this.classList.add('active');
            
            // Show/hide sections
            if (deptId === 'all') {
                sections.forEach(s => s.style.display = 'block');
            } else {
                sections.forEach(s => {
                    s.style.display = s.dataset.deptId === deptId ? 'block' : 'none';
                });
                // Smooth scroll to section
                const target = document.getElementById('dept-' + deptId);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
});
</script>
