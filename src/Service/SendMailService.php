<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendMailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmailByForm($form, $template): void
    {
        $email = (new TemplatedEmail())
            ->from($form->get('email')->getData())
            ->to('contact@jabamiah.eu')
            ->subject($form->get('object')->getData())
            ->htmlTemplate('emails/' . $template . '.html.twig')
            ->context(compact('form'));

        $this->mailer->send($email);
    }
}