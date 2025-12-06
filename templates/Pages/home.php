<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title', 'Welcome');
$user = $this->getRequest()->getAttribute('identity');
?>

<style>
/* Landing Page Specific Styles - Windows 11 Theme */
.home-container {
    padding-bottom: 60px;
}

/* Hero Section */
.hero-section {
    position: relative;
    padding: 100px 20px 80px;
    text-align: center;
    overflow: hidden;
}

/* Background Blob Animation */
.hero-bg-blob {
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(0,120,212,0.15) 0%, rgba(0,120,212,0) 70%);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
    animation: blobPulse 8s ease-in-out infinite;
    pointer-events: none;
}

@keyframes blobPulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.8; }
    50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.5; }
}

.hero-card {
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(40px) saturate(150%);
    -webkit-backdrop-filter: blur(40px) saturate(150%);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 16px;
    padding: 60px 40px;
    max-width: 900px;
    margin: 0 auto;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #0078d4, #005a9e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: #5d5d5d;
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Buttons */
.btn-hero {
    padding: 12px 32px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-hero-primary {
    background: #0078d4;
    color: white;
    box-shadow: 0 4px 12px rgba(0, 120, 212, 0.3);
    border: 1px solid transparent;
}

.btn-hero-primary:hover {
    background: #006cc1;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 120, 212, 0.4);
    color: white;
}

.btn-hero-secondary {
    background: rgba(255, 255, 255, 0.8);
    color: #333;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.btn-hero-secondary:hover {
    background: white;
    border-color: #0078d4;
    color: #0078d4;
}

/* Features Grid */
.features-section {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

.feature-card {
    background: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.5);
    border-radius: 12px;
    padding: 32px;
    transition: all 0.3s ease;
    text-align: left;
}

.feature-card:hover {
    background: rgba(255, 255, 255, 0.8);
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
}

.feature-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 20px;
}

.icon-blue { background: #e0f2fe; color: #0078d4; }
.icon-green { background: #dcfce7; color: #107c10; }
.icon-purple { background: #f3e8ff; color: #7c3aed; }

.feature-card h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 10px;
    color: #202020;
}

.feature-card p {
    color: #666;
    margin: 0;
    line-height: 1.6;
}
</style>

<div class="home-container">
    <div class="hero-section">
        <div class="hero-bg-blob"></div>
        
        <div class="hero-card">
            <h1 class="hero-title">Healthcare, Reimagined.</h1>
            <p class="hero-subtitle">
                A unified platform for patients and doctors. Book appointments, manage schedules, and access records with the clarity of OmniCare.
            </p>
            
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <?php if ($user): ?>
                    <?php
                    // Smart Redirect based on Role
                    $dashboardUrl = ['controller' => 'Appointments', 'action' => 'dashboard'];
                    if ($user->role === 'doctor') $dashboardUrl = ['controller' => 'Doctors', 'action' => 'dashboard'];
                    if ($user->role === 'patient') $dashboardUrl = ['controller' => 'Patients', 'action' => 'dashboard'];
                    ?>
                    <?= $this->Html->link(
                        'Go to Dashboard',
                        $dashboardUrl,
                        ['class' => 'btn btn-hero btn-hero-primary text-decoration-none']
                    ) ?>
                <?php else: ?>
                    <?= $this->Html->link(
                        'Login',
                        ['controller' => 'Users', 'action' => 'login'],
                        ['class' => 'btn btn-hero btn-hero-primary text-decoration-none']
                    ) ?>
                    <?= $this->Html->link(
                        'Create Account',
                        ['controller' => 'Users', 'action' => 'register'],
                        ['class' => 'btn btn-hero btn-hero-secondary text-decoration-none']
                    ) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="features-section">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon icon-blue">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3>Smart Scheduling</h3>
                <p>View real-time availability and book appointments instantly. Our intelligent system prevents double-bookings automatically.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-green">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Top Specialists</h3>
                <p>Browse detailed profiles of our doctors, filter by department, and find the perfect match for your healthcare needs.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon icon-purple">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <h3>Live Waiting List</h3>
                <p>Can't find a slot? Join our smart waiting list and get prioritized when an appointment becomes available.</p>
            </div>
        </div>
    </div>
</div>