<?php

namespace App\Service\Mail;

use App\Service\ConfigHelper;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    /**
     * @var ConfigHelper
     */
    private $configHelper;

    /**
     * @var GmailSmtpTransport
     */
    private $transport;

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(ConfigHelper $configHelper)
    {
        $this->configHelper = $configHelper;
    }

    public function getTransport(): GmailSmtpTransport
    {
        $username = $this->configHelper->getParameter('MAILER_USER');
        $password = $this->configHelper->getParameter('MAILER_PASS');

        if ($this->transport === null) {
            $this->transport = new GmailSmtpTransport($username, $password);
        }

        return $this->transport;
    }

    public function getMailer(): MailerInterface
    {
        $transport = $this->getTransport();

        if ($this->mailer === null) {
            $this->mailer = new Mailer($transport);
        }

        return $this->mailer;
    }

    public function sendMail(Email $email): void
    {
        try {
            $this->getMailer();
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw new TransportException($e->getMessage());
        }
    }

}