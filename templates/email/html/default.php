<?php
/**
 * OmniCare Email Layout
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title><?= $this->fetch('title') ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f8; margin: 0; padding: 0; }
        .email-container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        .header { background: linear-gradient(135deg, #0066cc, #004499); padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: 1px; }
        .content { padding: 40px 30px; color: #333333; line-height: 1.6; font-size: 16px; }
        .footer { background-color: #f8f9fa; padding: 20px; text-align: center; color: #888888; font-size: 12px; border-top: 1px solid #eeeeee; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #0066cc; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>OmniCare</h1>
        </div>
        
        <div class="content">
            <?= $this->fetch('content') ?>
        </div>
        
        <div class="footer">
            <p>&copy; <?= date('Y') ?> OmniCare Hospital Management System</p>
            <p>This is an automated message. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>