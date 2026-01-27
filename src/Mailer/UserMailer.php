<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    public function passwordReset($user, $resetUrl)
    {
        $this
            ->setTo($user->email)
            ->setSubject('OmniCare - Password Reset Request')
            ->setEmailFormat('html')
            ->setViewVars([
                'user' => $user,
                'resetUrl' => $resetUrl
            ]);
    }

    /**
     * Send contact form message to support
     */
    public function contactForm($data)
    {
        $this
            ->setTo('support@omnicare.com')
            ->setReplyTo($data['email'], $data['name'])
            ->setSubject('OmniCare Contact Form: ' . $data['subject'])
            ->setEmailFormat('html')
            ->setViewVars([
                'name' => $data['name'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'message' => $data['message']
            ]);
    }
}
