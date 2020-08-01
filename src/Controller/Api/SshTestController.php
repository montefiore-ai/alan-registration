<?php

namespace App\Controller\Api;

use App\Service\CommandExecutor\SlurmHelper;
use App\Service\ConfigHelper;
use App\Service\FreeIPA\FreeIPAHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ssh", name="ssh_")
 *
 * Class SshTestController
 * @package App\Controller\Api
 */
class SshTestController extends AbstractAPIController
{
    /**
     * @var SlurmHelper
     */
    private $slurmHelper;

    public function __construct(ConfigHelper $configHelper, SlurmHelper $slurmHelper)
    {
        parent::__construct($configHelper);
        $this->slurmHelper = $slurmHelper;
    }

    /**
     * @Route("/slurm/addgroup", name="slurm_assoc")
     * @return void
     */
    public function addUserToSlurmGroup(): void
    {
        $this->slurmHelper->addUserToSlurmGroup('test', 'priority-users');
    }

    /**
     * @Route("/generate")
     * @return void
     */
    public function generateSsh(): void
    {
        $this->slurmHelper->generateSshKey("gaetan@peinser.com", 'gaetand');
    }

    /**
     * @Route("/mail/test")
     * @param MailerInterface $mailer
     * @return JsonResponse
     */
    public function testDsn(MailerInterface $mailer): JsonResponse
    {
        $mail = (new Email())
            ->from('gaetan@peinser.com')
            ->to('gaetan1995@gmail.com')
            ->subject('Test DSN)')
            ->text('Hi')
            ->html('<strong>Ghello mi friend</strong>');

        try {
            $mailer->send($mail);
        } catch (TransportExceptionInterface $e) {
            die(sprintf('Error sending: %s', $e->getMessage()));
        }

        return $this->json(['data' => $mail], 200);
    }

}