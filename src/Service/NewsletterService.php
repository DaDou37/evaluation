<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class NewsletterService
{
    public function __construct(private MailerInterface $mailer) {}

    public function sendNewsletter(array $subscribers, string $subject, string $content): void
    {
        foreach ($subscribers as $subscriber) {
            $email = (new Email())
                ->from('ton-email@tonsite.com')
                ->to($subscriber->getEmail())
                ->subject($subject)
                ->html($content);

            $this->mailer->send($email);
        }
    }
}
