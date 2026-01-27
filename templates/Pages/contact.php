<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Contact Us');
?>

<div class="contact-page" style="overflow-x: hidden;">
    <!-- Hero Section -->
    <section class="position-relative py-5 bg-gradient-primary-soft">
        <div class="container py-5 position-relative z-index-1 text-center">
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm mb-3 fw-bold ls-1">
                <i class="fas fa-envelope-open-text me-2"></i> GET IN TOUCH
            </span>
            <h1 class="display-3 fw-bold mb-4 text-dark">We're Here to <span class="text-primary">Help</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Have questions or need assistance? Our support team is available 24/7 to ensure you get the care you
                deserve.
            </p>
        </div>
        <!-- Decorative Background -->
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-20"
            style="background-image: radial-gradient(#0078d4 1px, transparent 1px); background-size: 30px 30px; z-index: 0; pointer-events: none;">
        </div>
    </section>

    <div class="container py-5 mt-n5 position-relative z-index-2">
        <div class="row g-5">
            <!-- Contact Info & Map -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4 h-100">
                    <!-- Info Card -->
                    <div
                        class="card border-0 shadow-lg rounded-4 overflow-hidden bg-primary text-white position-relative">
                        <div class="card-body p-4 position-relative z-index-1">
                            <h3 class="fw-bold mb-4">Contact Information</h3>

                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box bg-white bg-opacity-20 rounded-circle p-3 me-3">
                                    <i class="fas fa-map-marker-alt fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 opacity-75 text-uppercase ls-1" style="font-size: 0.8rem;">
                                        Visit Us</h6>
                                    <p class="mb-0 fw-bold">123 Health Avenue, NY 10001</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box bg-white bg-opacity-20 rounded-circle p-3 me-3">
                                    <i class="fas fa-phone-alt fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 opacity-75 text-uppercase ls-1" style="font-size: 0.8rem;">
                                        Call Us</h6>
                                    <p class="mb-0 fw-bold">+1 (555) 123-4567</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-white bg-opacity-20 rounded-circle p-3 me-3">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 opacity-75 text-uppercase ls-1" style="font-size: 0.8rem;">
                                        Email Us</h6>
                                    <p class="mb-0 fw-bold">support@omnicare.com</p>
                                </div>
                            </div>
                        </div>
                        <!-- Decoration -->
                        <div class="position-absolute bottom-0 end-0 p-3 opacity-10">
                            <i class="fas fa-headset fa-6x"></i>
                        </div>
                    </div>

                    <!-- Map Embed -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden flex-grow-1">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1645564756836!5m2!1sen!2s"
                            width="100%" height="300" style="border:0; min-height: 300px;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 bg-white h-100">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4 text-dark">Send us a Message</h3>
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Pages', 'action' => 'contact']]) ?>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="name" name="name"
                                        placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-light border-0" id="email" name="email"
                                        placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0" id="subject"
                                        name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-light border-0" placeholder="Message" id="message"
                                        name="message" style="height: 150px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit"
                                    class="btn btn-primary btn-lg rounded-pill px-5 w-100 fw-bold hover-lift shadow">
                                    Send Message <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase fw-bold ls-1">Common Questions</h5>
                <h2 class="fw-bold">Frequently Asked Questions</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion accordion-flush" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm bg-light">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Do I need insurance to visit?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    No, we accept both insured and self-pay patients. We offer transparent pricing for
                                    all our services.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm bg-light">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq2">
                                    How can I cancel my appointment?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    You can cancel or reschedule your appointment directly through the Patient Dashboard
                                    up to 24 hours in advance.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm bg-light">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Is emergency care available?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Yes, we have a specialized 24/7 Emergency Department to handle critical medical
                                    situations.
                                </div>
                            </div>
                        </div>
                    </div>
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
        transform: translateY(-3px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .15) !important;
    }

    .ls-1 {
        letter-spacing: 1px;
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
        color: #0078d4;
        transform: scale(.85) translateY(-.5rem) translateX(.15rem);
    }

    .form-control:focus {
        box-shadow: none;
        background-color: #fff !important;
        border: 1px solid #0078d4 !important;
    }
</style>