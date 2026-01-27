<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Medical Services');

$services = [
    [
        'id' => 'general-medicine',
        'title' => 'General Medicine',
        'icon' => 'fa-stethoscope',
        'color' => 'primary',
        'desc' => 'Comprehensive primary care for all ages, including routine check-ups and preventive health strategies.',
        'fullDesc' => 'Our General Medicine department provides comprehensive primary healthcare services for patients of all ages. We focus on preventive care, early detection of diseases, and management of chronic conditions to help you maintain optimal health.',
        'features' => [
            'Annual health check-ups and wellness exams',
            'Chronic disease management (diabetes, hypertension)',
            'Vaccinations and immunizations',
            'Health risk assessments',
            'Minor illness and injury treatment',
            'Referrals to specialists when needed'
        ],
        'doctors' => 3,
        'waitTime' => '15 min'
    ],
    [
        'id' => 'cardiology',
        'title' => 'Cardiology',
        'icon' => 'fa-heartbeat',
        'color' => 'danger',
        'desc' => 'Advanced heart care services ranging from non-invasive diagnostics to complex surgical interventions.',
        'fullDesc' => 'Our Cardiology department is equipped with state-of-the-art technology for comprehensive heart care. From preventive cardiology to complex interventional procedures, our team of experienced cardiologists provides personalized treatment plans.',
        'features' => [
            'ECG and Echocardiography',
            'Stress testing and cardiac imaging',
            'Coronary angiography and angioplasty',
            'Pacemaker implantation',
            'Heart failure management',
            'Cardiac rehabilitation programs'
        ],
        'doctors' => 5,
        'waitTime' => '20 min'
    ],
    [
        'id' => 'pediatrics',
        'title' => 'Pediatrics',
        'icon' => 'fa-baby',
        'color' => 'warning',
        'desc' => 'Specialized healthcare for infants, children, and adolescents, ensuring healthy growth and development.',
        'fullDesc' => 'Our Pediatrics department is dedicated to the health and well-being of children from birth through adolescence. We provide a child-friendly environment with specialists trained in addressing the unique needs of young patients.',
        'features' => [
            'Well-child visits and growth monitoring',
            'Childhood vaccinations',
            'Developmental assessments',
            'Treatment of common childhood illnesses',
            'Adolescent medicine',
            'Nutritional counseling for children'
        ],
        'doctors' => 4,
        'waitTime' => '10 min'
    ],
    [
        'id' => 'orthopedics',
        'title' => 'Orthopedics',
        'icon' => 'fa-bone',
        'color' => 'info',
        'desc' => 'Expert diagnosis and treatment for bone, joint, and muscle conditions, including sports medicine.',
        'fullDesc' => 'Our Orthopedics department offers comprehensive musculoskeletal care, from conservative treatments to advanced surgical procedures. We specialize in treating injuries, degenerative conditions, and helping athletes return to peak performance.',
        'features' => [
            'Fracture treatment and bone surgery',
            'Joint replacement (hip, knee, shoulder)',
            'Sports medicine and injury rehabilitation',
            'Arthroscopic surgery',
            'Spine care and surgery',
            'Physical therapy coordination'
        ],
        'doctors' => 4,
        'waitTime' => '25 min'
    ],
    [
        'id' => 'dental-care',
        'title' => 'Dental Care',
        'icon' => 'fa-tooth',
        'color' => 'success',
        'desc' => 'Complete dental services from cleaning and whitening to root canals and cosmetic procedures.',
        'fullDesc' => 'Our Dental Care department provides comprehensive oral health services in a comfortable, modern setting. From routine cleanings to complex restorative work, our dentists use the latest techniques to give you a healthy, beautiful smile.',
        'features' => [
            'Routine dental exams and cleanings',
            'Teeth whitening and cosmetic dentistry',
            'Root canal therapy',
            'Dental implants and crowns',
            'Orthodontic consultations',
            'Emergency dental care'
        ],
        'doctors' => 3,
        'waitTime' => '15 min'
    ],
    [
        'id' => 'neurology',
        'title' => 'Neurology',
        'icon' => 'fa-brain',
        'color' => 'secondary',
        'desc' => 'State-of-the-art care for neurological disorders including stroke, epilepsy, and migraines.',
        'fullDesc' => 'Our Neurology department specializes in diagnosing and treating disorders of the nervous system. Using advanced diagnostic technology and evidence-based treatments, we help patients manage conditions ranging from headaches to complex neurological diseases.',
        'features' => [
            'EEG and nerve conduction studies',
            'Stroke prevention and treatment',
            'Epilepsy management',
            'Migraine and headache treatment',
            'Movement disorders (Parkinson\'s)',
            'Memory and cognitive assessments'
        ],
        'doctors' => 2,
        'waitTime' => '30 min'
    ],
];
?>

<div class="services-page" style="overflow-x: hidden;">
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
                <i class="fas fa-notes-medical me-2"></i> WORLD CLASS CARE
            </span>
            <h1 class="display-3 fw-bold mb-4 text-dark">Comprehensive <span class="text-primary">Services</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                We utilize the latest medical technologies to provide you with the best possible care across a wide
                range of specialties.
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-4">
                <?php foreach ($services as $service): ?>
                    <div class="col-md-6 col-lg-4">
                        <div
                            class="service-card p-4 h-100 rounded-4 border bg-white position-relative overflow-hidden hover-lift group">
                            <!-- Icon -->
                            <div class="icon-wrapper mb-4 rounded-circle d-flex align-items-center justify-content-center bg-light text-<?= $service['color'] ?>"
                                style="width: 70px; height: 70px; font-size: 1.8rem; transition: all 0.3s;">
                                <i class="fas <?= $service['icon'] ?>"></i>
                            </div>

                            <h4 class="fw-bold mb-3"><?= h($service['title']) ?></h4>
                            <p class="text-muted mb-4"><?= h($service['desc']) ?></p>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-<?= $service['id'] ?>"
                                class="text-decoration-none fw-bold d-flex align-items-center text-primary group-hover-arrow">
                                Learn More <i class="fas fa-arrow-right ms-2 transition-transform"></i>
                            </a>

                            <!-- Hover Gradient Overlay -->
                            <div class="position-absolute bottom-0 end-0 opacity-0 group-hover-show pe-none"
                                style="transform: translate(30%, 30%);">
                                <i class="fas <?= $service['icon'] ?>"
                                    style="font-size: 10rem; color: rgba(0,120,212,0.05);"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase fw-bold ls-1">How It Works</h5>
                <h2 class="fw-bold">Simple Steps to Your Health</h2>
            </div>

            <div class="row g-4 text-center position-relative">
                <!-- Connecting Line (Desktop) -->
                <div class="d-none d-lg-block position-absolute top-50 start-0 w-100 translate-middle-y"
                    style="z-index: 0; border-top: 2px dashed #dee2e6; height: 0;"></div>

                <!-- Step 1 -->
                <div class="col-lg-4 position-relative z-index-1">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="width: 60px; height: 60px; font-size: 1.5rem;">
                            1
                        </div>
                        <h5 class="fw-bold">Choose Service</h5>
                        <p class="text-muted small">Browse our wide range of medical specialties and find the right one
                            for you.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="col-lg-4 position-relative z-index-1">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="width: 60px; height: 60px; font-size: 1.5rem;">
                            2
                        </div>
                        <h5 class="fw-bold">Book Appointment</h5>
                        <p class="text-muted small">Use our easy online scheduling system to pick a time that works for
                            you.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="col-lg-4 position-relative z-index-1">
                    <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                        <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-check"></i>
                        </div>
                        <h5 class="fw-bold">Get Treated</h5>
                        <p class="text-muted small">Visit our clinic and receive world-class care from our expert
                            doctors.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-dark text-white position-relative overflow-hidden">
        <div class="container py-5 text-center px-4 position-relative z-index-1">
            <h2 class="fw-bold mb-3">Don't See What You Need?</h2>
            <p class="lead text-white-50 mb-5">Our team is ready to assist you with any inquiries or special
                requirements.</p>
            <div class="d-flex justify-content-center gap-3">
                <?= $this->Html->link('Contact Us', ['action' => 'contact'], ['class' => 'btn btn-primary btn-lg rounded-pill px-5']) ?>
                <?= $this->Html->link('FAQ', '#', ['class' => 'btn btn-outline-light btn-lg rounded-pill px-5']) ?>
            </div>
        </div>
        <!-- Decorations -->
        <div class="position-absolute top-0 end-0 p-5 opacity-10">
            <i class="fas fa-comments fa-10x"></i>
        </div>
    </section>
</div>

<!-- Service Detail Modals -->
<?php foreach ($services as $service): ?>
    <div class="modal fade" id="modal-<?= $service['id'] ?>" tabindex="-1"
        aria-labelledby="modalLabel-<?= $service['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <!-- Modal Header with Gradient -->
                <div class="modal-header border-0 bg-<?= $service['color'] ?> text-white py-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 60px; height: 60px;">
                            <i class="fas <?= $service['icon'] ?> fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="modal-title fw-bold mb-0" id="modalLabel-<?= $service['id'] ?>">
                                <?= h($service['title']) ?></h4>
                            <small class="opacity-75">Medical Specialty</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <!-- Description -->
                    <p class="lead text-muted mb-4"><?= h($service['fullDesc']) ?></p>

                    <!-- Quick Stats -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <i class="fas fa-user-md text-<?= $service['color'] ?> mb-2" style="font-size: 1.5rem;"></i>
                                <div class="fw-bold"><?= $service['doctors'] ?> Doctors</div>
                                <small class="text-muted">Available</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <i class="fas fa-clock text-<?= $service['color'] ?> mb-2" style="font-size: 1.5rem;"></i>
                                <div class="fw-bold"><?= $service['waitTime'] ?></div>
                                <small class="text-muted">Avg. Wait</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <i class="fas fa-calendar-check text-<?= $service['color'] ?> mb-2"
                                    style="font-size: 1.5rem;"></i>
                                <div class="fw-bold">Same Day</div>
                                <small class="text-muted">Booking</small>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <i class="fas fa-star text-warning mb-2" style="font-size: 1.5rem;"></i>
                                <div class="fw-bold">4.9 Rating</div>
                                <small class="text-muted">Patient Score</small>
                            </div>
                        </div>
                    </div>

                    <!-- Features List -->
                    <h6 class="fw-bold text-uppercase text-muted small ls-1 mb-3">
                        <i class="fas fa-list-check me-2"></i>Services Offered
                    </h6>
                    <div class="row g-2 mb-4">
                        <?php foreach ($service['features'] as $feature): ?>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-<?= $service['color'] ?> me-2"></i>
                                    <span><?= h($feature) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Insurance Note -->
                    <div class="alert alert-light border rounded-3 mb-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt text-success me-3 fa-lg"></i>
                            <div>
                                <strong>Insurance Accepted</strong>
                                <p class="mb-0 small text-muted">We accept most major insurance providers. Contact us for
                                    verification.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 bg-light py-3">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        Close
                    </button>
                    <?= $this->Html->link(
                        '<i class="fas fa-calendar-plus me-2"></i>Book Appointment',
                        ['controller' => 'Users', 'action' => 'login'],
                        ['class' => 'btn btn-' . $service['color'] . ' rounded-pill px-4', 'escape' => false]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<style>
    .bg-gradient-primary-soft {
        background: linear-gradient(180deg, #f0f8ff, #ffffff);
    }

    .hover-lift {
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
    }

    .group:hover .group-hover-arrow i {
        transform: translateX(5px);
    }

    .group:hover .icon-wrapper {
        background-color: #0078d4 !important;
        color: white !important;
    }

    .transition-transform {
        transition: transform 0.2s;
    }

    .ls-1 {
        letter-spacing: 1px;
    }

    /* Modal Animations */
    .modal.fade .modal-dialog {
        transform: scale(0.9);
        transition: transform 0.3s ease-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>