<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OmniCare - Hospital Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <?php // Ensure CakePHP helpers and elements work on home page ?>
    <?= $this->Html->css(['style']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f8f9fa;
            color: #1f1f1f;
            overflow-x: hidden;
            /* Add top padding to account for fixed topbar */
            padding-top: 56px;
        }

        /* Background Animation */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 102, 204, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        /* Main Container */
        .homepage-container {
            min-height: calc(100vh - 56px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            max-width: 1680px;
            margin: 0 auto;
        }

        /* Hero Section */
        .hero-section {
            text-align: center;
            padding: 60px 40px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #0066cc, #22c55e, #0066cc);
            background-size: 200% 100%;
            animation: gradientShift 3s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Logo Section */
        .logo-section {
            margin-bottom: 40px;
            position: relative;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0066cc, #004499);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.3);
            animation: logoFloat 6s ease-in-out infinite;
        }

        .logo-icon i {
            font-size: 36px;
            color: white;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Typography */
        .hero-title {
            font-size: 48px;
            font-weight: 700;
            color: #1f1f1f;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .hero-title .brand-name {
            background: linear-gradient(135deg, #0066cc, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 18px;
            color: #666;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .hero-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Hero Image */
        .hero-image {
            margin: 40px 0;
            position: relative;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .hero-image:hover img {
            transform: scale(1.02);
        }

        /* CTA Buttons */
        .cta-section {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 32px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            font-family: inherit;
            min-width: 180px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0066cc, #004499);
            color: white;
            box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0052a3, #003366);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.4);
            color: white;
        }

        .btn-outline {
            background: transparent;
            color: #0066cc;
            border: 2px solid #0066cc;
        }

        .btn-outline:hover {
            background: #0066cc;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.3);
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .feature-card {
            background: rgba(248, 249, 250, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 24px 20px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: rgba(0, 102, 204, 0.05);
            border-color: #0066cc;
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.1);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0066cc, #004499);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: white;
            font-size: 20px;
        }

        .feature-title {
            font-size: 14px;
            font-weight: 600;
            color: #1f1f1f;
            margin-bottom: 8px;
        }

        .feature-description {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        /* Stats Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 20px;
            margin: 40px 0;
            padding: 20px 0;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #0066cc;
            margin-bottom: 4px;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Footer Info */
        .footer-info {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .footer-info a {
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-info a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .homepage-container {
                padding: 16px;
            }
            
            .hero-section {
                padding: 40px 24px;
                border-radius: 16px;
            }
            
            .hero-title {
                font-size: 36px;
            }
            
            .hero-subtitle {
                font-size: 16px;
            }
            
            .hero-description {
                font-size: 14px;
            }
            
            .cta-section {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 280px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 28px;
            }
            
            .logo-icon {
                width: 64px;
                height: 64px;
            }
            
            .logo-icon i {
                font-size: 28px;
            }
            
            .btn {
                padding: 14px 24px;
                font-size: 14px;
            }
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .loading-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loading-spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(0, 102, 204, 0.2);
            border-top: 4px solid #0066cc;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Ensure topbar doesn't get affected by home styles */
        .topbar,
        .topbar * {
            font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Include Topbar Component - This should be included from your PHP -->
    <?= $this->element('topbar_home') ?>

    <div class="homepage-container">
        <div class="hero-section">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-hospital"></i>
                </div>
            </div>

            <!-- Main Content -->
            <h1 class="hero-title">
                Welcome to <span class="brand-name">OmniCare</span>
            </h1>
            
            <p class="hero-subtitle">
                Online Medical Network for Integrated Clinical Appointment Reservations
            </p>
            
            <p class="hero-description">
                Experience seamless healthcare management with our modern, comprehensive hospital appointment system. 
                Book appointments, manage patient records, and streamline medical workflows with ease.
            </p>

            <!-- Hero Image -->
            <div class="hero-image">
                <img src="/webroot/img/omnicare-hero.png" alt="OmniCare Hospital Management System" 
                     style="max-width: 320px; width: 100%;" 
                     onerror="this.style.display='none'">
            </div>

            <!-- Call to Action -->
<div class="cta-section">
    <?= $this->Html->link(
        '<i class="fas fa-calendar-plus"></i> Book Appointment',
        ['controller' => 'Users', 'action' => 'login'],
        ['class' => 'btn btn-primary', 'escape' => false]
    ) ?>
    <?= $this->Html->link(
        '<i class="fas fa-user-plus"></i> Register Now',
        ['controller' => 'Users', 'action' => 'register'],
        ['class' => 'btn btn-outline', 'escape' => false]
    ) ?>
</div>

            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stat-item">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Available</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100+</span>
                    <span class="stat-label">Patients</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">10+</span>
                    <span class="stat-label">Doctors</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">8</span>
                    <span class="stat-label">Departments</span>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="feature-title">Easy Scheduling</div>
                    <div class="feature-description">Book and manage appointments with just a few clicks</div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="feature-title">Expert Doctors</div>
                    <div class="feature-description">Access to qualified medical professionals</div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-title">Secure & Private</div>
                    <div class="feature-description">Your medical data is protected and confidential</div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div class="feature-title">Mobile Friendly</div>
                    <div class="feature-description">Access from any device, anywhere, anytime</div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="footer-info">
                <p>Need help? <a href="/users/login">Contact our support team</a> or <a href="/users/login">browse our FAQ</a></p>
            </div>
        </div>
    </div>

    <script>
        // Hide loading overlay when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loadingOverlay').classList.add('hidden');
            }, 500);
        });

        // Add smooth scrolling and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats numbers
            const statNumbers = document.querySelectorAll('.stat-number');
            
            const animateStats = () => {
                statNumbers.forEach(stat => {
                    const text = stat.textContent;
                    if (text.includes('+')) {
                        const number = parseInt(text.replace(/[^0-9]/g, ''));
                        let current = 0;
                        const increment = number / 50;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= number) {
                                stat.textContent = text;
                                clearInterval(timer);
                            } else {
                                stat.textContent = Math.floor(current) + (text.includes('+') ? '+' : '');
                            }
                        }, 20);
                    }
                });
            };

            // Trigger animation when stats come into view
            const statsSection = document.querySelector('.stats-section');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateStats();
                        observer.unobserve(entry.target);
                    }
                });
            });

            if (statsSection) {
                observer.observe(statsSection);
            }

            // Add hover effects to feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(-4px) scale(1)';
                });
            });
        });
    </script>
</body>
</html>