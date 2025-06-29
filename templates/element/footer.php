<?php
// ===== MODERN FOOTER ELEMENT =====
// File: templates/element/footer.php
?>

<style>
.modern-footer {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    padding: 24px 0;
    margin-top: auto;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
}

.footer-container {
    max-width: 1680px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #0066cc;
    font-weight: 600;
    font-size: 16px;
}

.footer-logo i {
    font-size: 18px;
}

.footer-links {
    display: flex;
    gap: 24px;
    align-items: center;
}

.footer-links a {
    color: #666;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.2s ease;
}

.footer-links a:hover {
    color: #0066cc;
}

.footer-copy {
    color: #999;
    font-size: 13px;
}

@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
        padding: 0 16px;
    }
    
    .footer-links {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>

<footer class="modern-footer">
    <div class="footer-container">
        <div class="footer-logo">
            <i class="fas fa-hospital"></i>
            <span>OmniCare</span>
        </div>
        
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Contact</a>
            <a href="#">Help</a>
        </div>
        
        <div class="footer-copy">
            &copy; <?= date('Y') ?> OmniCare. All rights reserved.
        </div>
    </div>
</footer>