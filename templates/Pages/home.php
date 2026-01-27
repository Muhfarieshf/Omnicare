<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $featuredDepartments
 */
$this->assign('title', 'Welcome');
?>

<div class="home-container" style="overflow-x: hidden;">
    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center position-relative"
        style="min-height: 90vh; padding-top: 80px;">
        <!-- Background Elements -->
        <div class="hero-bg-blob"></div>
        <div class="hero-bg-blob-2"></div>

        <div class="container position-relative z-index-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3 py-2 rounded-pill fw-bold ls-1">
                        <i class="fas fa-star me-2"></i> #1 RATED HEALTHCARE
                    </span>
                    <h1 class="display-3 fw-bold mb-4 text-dark lh-sm">
                        Your Health Is <br>
                        <span class="text-primary position-relative">
                            Our Top Priority
                            <svg class="position-absolute w-100"
                                style="bottom: 0; left: 0; height: 12px; z-index: -1; fill: rgba(0,120,212,0.2);"
                                viewBox="0 0 100 100" preserveAspectRatio="none">
                                <rect width="100" height="100" />
                            </svg>
                        </span>
                    </h1>
                    <p class="lead text-muted mb-5 hero-subtitle" style="max-width: 500px;">
                        Experience world-class medical care with our team of expert doctors.
                        Modern facilities, compassionate staff, and smart scheduling.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <?= $this->Html->link(
                            'Book Appointment <i class="fas fa-arrow-right ms-2"></i>',
                            ['controller' => 'Appointments', 'action' => 'add'],
                            ['class' => 'btn btn-primary btn-lg px-4 py-3 rounded-pill shadow-lg hover-lift', 'escape' => false]
                        ) ?>
                        <?= $this->Html->link(
                            'Our Services',
                            ['controller' => 'Pages', 'action' => 'display', 'services'],
                            ['class' => 'btn btn-outline-secondary btn-lg px-4 py-3 rounded-pill hover-lift']
                        ) ?>
                    </div>

                    <div class="mt-5 pt-4 border-top d-flex align-items-center gap-5">
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">50+</h3>
                            <small class="text-muted text-uppercase">Specialists</small>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">10k+</h3>
                            <small class="text-muted text-uppercase">Happy Patients</small>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0 text-dark">4.9/5</h3>
                            <small class="text-muted text-uppercase">Rating</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 position-relative">
                    <div
                        class="hero-image-wrapper p-4 bg-white bg-opacity-50 backdrop-blur rounded-circle shadow-custom animation-float">
                        <!-- Placeholder Image -->
                        <img src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            alt="Doctor" class="img-fluid rounded-circle shadow-lg position-relative z-index-2"
                            style="border: 10px solid rgba(255,255,255,0.8);">
                    </div>
                    <!-- Decorative Elements -->
                    <div class="position-absolute top-0 end-0 bg-white p-3 rounded-3 shadow-lg animation-bounce-slow"
                        style="margin-top: 100px; margin-right: -20px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success bg-opacity-10 p-2 rounded-circle text-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <small class="d-block text-muted">Status</small>
                                <span class="fw-bold text-success">Available Now</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light position-relative">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card h-100 p-4 bg-white rounded-4 shadow-sm hover-shadow transition-all">
                        <div
                            class="icon-box mb-4 bg-primary bg-opacity-10 text-primary p-3 rounded-circle d-inline-block">
                            <i class="fas fa-user-md fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Expert Doctors</h4>
                        <p class="text-muted">Our team consists of highly qualified professionals dedicated to your
                            well-being.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card h-100 p-4 bg-white rounded-4 shadow-sm hover-shadow transition-all">
                        <div
                            class="icon-box mb-4 bg-success bg-opacity-10 text-success p-3 rounded-circle d-inline-block">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">24/7 Service</h4>
                        <p class="text-muted">Medical care should never wait. We are available round the clock for
                            emergencies.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card h-100 p-4 bg-white rounded-4 shadow-sm hover-shadow transition-all">
                        <div class="icon-box mb-4 bg-info bg-opacity-10 text-info p-3 rounded-circle d-inline-block">
                            <i class="fas fa-microscope fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Modern Tech</h4>
                        <p class="text-muted">We utilize the latest medical technology for accurate diagnosis and
                            treatment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Departments -->
    <section class="py-5" style="background: #fff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase ls-1 fw-bold">Our Specialties</h5>
                <h2 class="fw-bold display-5">Popular Departments</h2>
            </div>

            <div class="row g-4">
                <?php if (!empty($featuredDepartments)): ?>
                    <?php foreach ($featuredDepartments as $dept): ?>
                        <div class="col-md-4">
                            <div class="department-card border rounded-4 p-4 text-center hover-lift transition-all h-100">
                                <div class="mb-4">
                                    <div class="avatar-lg bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 80px; height: 80px;">
                                        <i class="fas fa-heartbeat fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold mb-3"><?= h($dept->name) ?></h4>
                                <p class="text-muted mb-4">Specialized care and advanced treatment options.</p>
                                <?= $this->Html->link('Learn More', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'text-primary fw-bold text-decoration-none']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center text-muted">
                        <p>Departments are being updated.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5">
                <?= $this->Html->link('View All Services', ['controller' => 'Pages', 'action' => 'display', 'services'], ['class' => 'btn btn-outline-primary btn-lg rounded-pill px-5']) ?>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-gradient-primary-soft">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-5">
                        <i class="fas fa-quote-left fa-3x text-primary opacity-25"></i>
                    </div>
                    <h2 class="mb-4 fw-bold">"The care I received at OmniCare was exceptional. The staff was friendly,
                        and the doctors were incredibly professional."</h2>
                    <div class="d-flex align-items-center justify-content-center gap-3">
                         <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle shadow-sm" width="60" alt="Patient">
                         <div class="text-start">
                            <h5 class="fw-bold mb-0">Sarah Johnson</h5>
                            <small class="text-muted">Patient</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white position-relative overflow-hidden">
        <div class="container py-5 position-relative z-index-1 text-center">
            <h2 class="display-6 fw-bold mb-4">Ready to Prioritize Your Health?</h2>
            <p class="lead mb-5 text-white-50">Book an appointment online in less than 2 minutes.</p>
            <?= $this->Html->link(
                'Book Now',
                ['controller' => 'Appointments', 'action' => 'add'],
                ['class' => 'btn btn-light text-primary btn-lg px-5 py-3 rounded-pill fw-bold hover-lift shadow']
            ) ?>
        </div>
        <!-- Decorative Circle -->
        <div class="position-absolute top-50 start-50 translate-middle border border-white opacity-10 rounded-circle"
            style="width: 800px; height: 800px;"></div>
    </section>
</div>

<style>
    /* Additional Animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes blobPulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.8;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.6;
        }
    }

    .animation-float {
        animation: float 6s ease-in-out infinite;
    }

    .animation-bounce-slow {
        animation: float 4s ease-in-out infinite reverse;
    }

    .hover-lift {
        transition: transform 0.2s;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .backdrop-blur {
        backdrop-filter: blur(10px);
    }

    .shadow-custom {
        box-shadow: 0 20px 40px rgba(0, 120, 212, 0.1);
    }

    .bg-gradient-primary-soft {
        background: linear-gradient(135deg, #f0f7ff, #ffffff);
    }

    .hero-bg-blob {
        position: absolute;
        top: -20%;
        right: -10%;
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(0, 120, 212, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
        animation: blobPulse 10s infinite;
    }

    .hero-bg-blob-2 {
        position: absolute;
        bottom: -10%;
        left: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(0, 255, 127, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
    }
</style>