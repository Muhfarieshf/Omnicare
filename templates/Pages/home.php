<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title', 'Welcome');
$user = $this->getRequest()->getAttribute('identity');
?>

<style>
/* Landing Page Specific Styles */
.hero-section {
    background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%);
    padding: 80px 20px;
    border-radius: 24px;
    margin: 20px 20px 60px 20px;
    box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #0066cc, #004499);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 20px;
    letter-spacing: -1px;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin-bottom: 40px;
    line-height: 1.6;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 0 20px;
    margin-bottom: 80px;
}

.feature-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 32px;
    border: 1px solid rgba(255, 255, 255, 0.5);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: left;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 20px;
    color: white;
}

.icon-schedule { background: linear-gradient(135deg, #0066cc, #004499); }
.icon-doctors { background: linear-gradient(135deg, #22c55e, #16a34a); }
.icon-records { background: linear-gradient(135deg, #f59e0b, #d97706); }

.feature-card h3 {
    font-size: 1.5rem;
    color: #1f1f1f;
    margin-bottom: 12px;
    font-weight: 700;
}

.feature-card p {
    color: #666;
    font-size: 1rem;
    line-height: 1.6;
}

.cta-section {
    text-align: center;
    padding: 80px 20px;
    background: linear-gradient(135deg, #0066cc, #004499);
    margin: 0 20px 20px 20px;
    border-radius: 24px;
    color: white;
}

.btn-hero {
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-hero-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 102, 204, 0.4);
}

.btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.5);
    color: white;
}

.btn-hero-white {
    background: white;
    color: #0066cc;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-hero-white:hover {
    transform: translateY(-2px);
    background: #f8f9fa;
    color: #004499;
}

@media (max-width: 768px) {
    .hero-title { font-size: 2.5rem; }
    .hero-section { margin: 10px; padding: 40px 20px; }
    .cta-section { margin: 10px; }
}
</style>

<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Healthcare Simplified.</h1>
        <p class="hero-subtitle">
            Experience the future of hospital management. Book appointments, manage patient records, and streamline your clinic's workflow with OmniCare.
        </p>
        
        <div class="d-flex gap-3 justify-content-center">
            <?php if ($user): ?>
                <?php
                // Redirect to dashboard based on role
                $dashboardUrl = ['controller' => 'Appointments', 'action' => 'dashboard'];
                if ($user->role === 'doctor') $dashboardUrl = ['controller' => 'Doctors', 'action' => 'dashboard'];
                if ($user->role === 'patient') $dashboardUrl = ['controller' => 'Patients', 'action' => 'dashboard'];
                ?>
                <?= $this->Html->link(
                    'Go to Dashboard <i class="fas fa-arrow-right ms-2"></i>',
                    $dashboardUrl,
                    ['class' => 'btn btn-hero btn-hero-primary', 'escape' => false]
                ) ?>
            <?php else: ?>
                <?= $this->Html->link(
                    'Book Appointment',
                    ['controller' => 'Users', 'action' => 'login'], // Redirects to login then booking
                    ['class' => 'btn btn-hero btn-hero-primary']
                ) ?>
                <?= $this->Html->link(
                    'Patient Portal',
                    ['controller' => 'Users', 'action' => 'login'],
                    ['class' => 'btn btn-hero btn-hero-white border']
                ) ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container-fluid" style="max-width: 1200px; margin: 0 auto;">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon icon-schedule">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3>Smart Scheduling</h3>
            <p>Book appointments effortlessly with our real-time availability checker. Never double-book again with intelligent conflict detection.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-doctors">
                <i class="fas fa-user-md"></i>
            </div>
            <h3>Expert Doctors</h3>
            <p>Access detailed profiles of our specialists. Find the right doctor for your needs by department, expertise, or availability.</p>
        </div>

        <div class="feature-card">
            <div class="feature-icon icon-records">
                <i class="fas fa-file-medical"></i>
            </div>
            <h3>Digital Records</h3>
            <p>Securely store and access patient history. Track appointment status from scheduled to completed in one unified timeline.</p>
        </div>
    </div>
</div>

<div class="cta-section">
    <h2 class="mb-4 fw-bold">Ready to modernize your healthcare experience?</h2>
    <p class="mb-5 opacity-75 fs-5">Join thousands of patients and doctors trusting OmniCare.</p>
    
    <?php if (!$user): ?>
        <?= $this->Html->link(
            'Create Free Account',
            ['controller' => 'Users', 'action' => 'register'],
            ['class' => 'btn btn-hero btn-hero-white']
        ) ?>
    <?php endif; ?>
</div>