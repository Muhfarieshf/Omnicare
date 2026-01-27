<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Password Reset</title>
</head>

<body
    style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div
        style="background: linear-gradient(135deg, #0078d4 0%, #00a2ff 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0;">OmniCare</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">Password Reset Request</p>
    </div>

    <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px;">
        <p>Hello <strong>
                <?= h($user->username) ?>
            </strong>,</p>

        <p>We received a request to reset your password. Click the button below to create a new password:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="<?= $resetUrl ?>"
                style="background: #0078d4; color: white; padding: 15px 30px; text-decoration: none; border-radius: 25px; font-weight: bold; display: inline-block;">
                Reset Password
            </a>
        </div>

        <p style="color: #666; font-size: 14px;">
            If you didn't request this, you can safely ignore this email. The link will expire in <strong>1
                hour</strong>.
        </p>

        <p style="color: #999; font-size: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;">
            If the button doesn't work, copy and paste this link into your browser:<br>
            <a href="<?= $resetUrl ?>" style="color: #0078d4; word-break: break-all;">
                <?= $resetUrl ?>
            </a>
        </p>
    </div>

    <p style="text-align: center; color: #999; font-size: 12px; margin-top: 20px;">
        &copy;
        <?= date('Y') ?> OmniCare. All rights reserved.
    </p>
</body>

</html>