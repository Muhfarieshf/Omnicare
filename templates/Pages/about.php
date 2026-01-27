<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'About Us');
?>

<div class="about-page" style="overflow-x: hidden;">
    <!-- Hero Section -->
    <section class="position-relative py-5 bg-gradient-primary-soft">
        <div class="container py-5 position-relative z-index-1 text-center">
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm mb-3 fw-bold ls-1">
                <i class="fas fa-hospital-alt me-2"></i> EST. 2020
            </span>
            <h1 class="display-3 fw-bold mb-4 text-dark">Driven by <span class="text-primary">Compassion</span>,<br>Led
                by <span class="text-primary">Science</span>.</h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                OmniCare is reshaping the healthcare experience by combining advanced medical technology with a
                patient-first approach.
            </p>
        </div>
        <!-- Background Blob -->
        <div class="position-absolute top-50 start-50 translate-middle"
            style="z-index: 0; width: 600px; height: 600px; background: radial-gradient(circle, rgba(0,120,212,0.05) 0%, rgba(255,255,255,0) 70%); pointer-events: none;">
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 position-relative">
                    <div class="position-relative ps-4 pt-4">
                        <img src="https://placehold.co/1000x600?text=Medical+Team" alt="Medical Team"
                            class="img-fluid rounded-4 shadow-lg position-relative z-index-2">
                        <!-- Decorative bg -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-10 rounded-4"
                            style="transform: translate(-20px, -20px); z-index: 1;"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="text-primary fw-bold text-uppercase ls-1 mb-3">Our Story</h5>
                    <h2 class="fw-bold mb-4 display-6">Bridging the Gap Between Patients & Care.</h2>
                    <p class="text-muted mb-4 lead">
                        Founded with a simple mission: to make healthcare accessible, efficient, and human.
                    </p>
                    <p class="text-muted mb-4">
                        OmniCare started as a small initiative to digitalize appointment bookings. Today, we are a
                        comprehensive healthcare network serving thousands. We believe that technology should empower
                        doctors to spend more time doing what they do best: caring for patients.
                    </p>

                    <div class="row g-4 mt-2">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3">
                                    <i class="fas fa-check fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0">Certified</h5>
                                    <small class="text-muted">ISO 9001:2015</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle p-3">
                                    <i class="fas fa-award fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0">Awarded</h5>
                                    <small class="text-muted">Best Clinic 2024</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Our Core Values</h2>
                <p class="text-muted">The principles that guide every decision we make.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift p-4 text-center">
                        <div class="mb-4 mx-auto bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Compassion</h4>
                        <p class="text-muted">We treat every patient with kindness, empathy, and respect. Healing starts
                            with listening.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift p-4 text-center">
                        <div class="mb-4 mx-auto bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-microscope fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Innovation</h4>
                        <p class="text-muted">We embrace the latest medical advancements to provide superior diagnostic
                            and treatment options.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift p-4 text-center">
                        <div class="mb-4 mx-auto bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4 class="fw-bold">Integrity</h4>
                        <p class="text-muted">Honesty and transparency are the foundation of our practice. We put
                            patient trust above all else.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Team -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase fw-bold ls-1">Leadership</h5>
                <h2 class="fw-bold">Meet Our Directors</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Director 1 -->
                <div class="col-md-4 col-lg-3">
                    <div class="text-center group">
                        <div class="position-relative mb-3 d-inline-block">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg"
                                class="rounded-circle shadow-lg mb-3" width="150" height="150" alt="CEO">
                            <div
                                class="position-absolute bottom-0 end-0 bg-white p-2 rounded-circle shadow-sm text-primary">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-1">Dr. Sarah Smith</h5>
                        <small class="text-muted text-uppercase ls-1">Chief Executive Officer</small>
                    </div>
                </div>
                <!-- Director 2 -->
                <div class="col-md-4 col-lg-3">
                    <div class="text-center group">
                        <div class="position-relative mb-3 d-inline-block">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg"
                                class="rounded-circle shadow-lg mb-3" width="150" height="150" alt="CMO">
                            <div
                                class="position-absolute bottom-0 end-0 bg-white p-2 rounded-circle shadow-sm text-primary">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-1">Dr. James Wilson</h5>
                        <small class="text-muted text-uppercase ls-1">Chief Medical Officer</small>
                    </div>
                </div>
                <!-- Director 3 -->
                <div class="col-md-4 col-lg-3">
                    <div class="text-center group">
                        <div class="position-relative mb-3 d-inline-block">
                            <img src="https://randomuser.me/api/portraits/women/90.jpg"
                                class="rounded-circle shadow-lg mb-3" width="150" height="150" alt="Head of Surgery">
                            <div
                                class="position-absolute bottom-0 end-0 bg-white p-2 rounded-circle shadow-sm text-primary">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-1">Dr. Emily Chen</h5>
                        <small class="text-muted text-uppercase ls-1">Head of Surgery</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold">50+</div>
                    <div class="text-light opacity-75 small text-uppercase ls-1">Doctors</div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold">12k</div>
                    <div class="text-light opacity-75 small text-uppercase ls-1">Surgeries</div>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold">3</div>
                    <div class="text-light opacity-75 small text-uppercase ls-1">Locations</div>
                </div>
                <div class="col-md-3">
                    <div class="display-4 fw-bold">100%</div>
                    <div class="text-light opacity-75 small text-uppercase ls-1">Commitment</div>
                </div>
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
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .1) !important;
    }

    .ls-1 {
        letter-spacing: 1px;
    }
</style>