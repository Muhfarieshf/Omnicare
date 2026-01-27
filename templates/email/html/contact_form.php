<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact Form Message</title>
</head>

<body
    style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div
        style="background: linear-gradient(135deg, #0078d4 0%, #00a2ff 100%); padding: 30px; text-align: center; border-radius: 10px 10px 0 0;">
        <h1 style="color: white; margin: 0;">OmniCare</h1>
        <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0;">New Contact Form Message</p>
    </div>

    <div style="background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px;">
        <p>You have received a new message from the contact form:</p>

        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <td style="padding: 10px; background: #fff; border: 1px solid #ddd; font-weight: bold; width: 120px;">
                    Name:</td>
                <td style="padding: 10px; background: #fff; border: 1px solid #ddd;">
                    <?= h($name) ?>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; background: #fff; border: 1px solid #ddd; font-weight: bold;">Email:</td>
                <td style="padding: 10px; background: #fff; border: 1px solid #ddd;"><a href="mailto:<?= h($email) ?>"
                        style="color: #0078d4;">
                        <?= h($email) ?>
                    </a></td>
            </tr>
            <tr>
                <td style="padding: 10px; background: #fff; border: 1px solid #ddd; font-weight: bold;">Subject:</td>
                <td style="padding: 10px; background: #fff; border: 1px solid #ddd;">
                    <?= h($subject) ?>
                </td>
            </tr>
        </table>

        <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-top: 20px;">
            <p style="font-weight: bold; margin: 0 0 10px 0;">Message:</p>
            <p style="margin: 0; white-space: pre-wrap;">
                <?= h($message) ?>
            </p>
        </div>

        <p style="color: #666; font-size: 14px; margin-top: 20px;">
            You can reply directly to this email to respond to the sender.
        </p>
    </div>

    <p style="text-align: center; color: #999; font-size: 12px; margin-top: 20px;">
        &copy;
        <?= date('Y') ?> OmniCare. All rights reserved.
    </p>
</body>

</html>