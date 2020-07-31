<?php

namespace App\Service\Mail;

use App\Entity\AccessRequest;
use App\Service\ConfigHelper;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class MailHelper
{
    /**
     * @var MailService
     */
    private $mailService;

    /**
     * @var ConfigHelper
     */
    private $configHelper;

    /**
     * @var BodyRenderer $bodyRenderer
     */
    private $bodyRenderer;

    /**
     * @var KernelInterface $appKernel
     */
    private $appKernel;

    public function __construct(MailService $mailService, ConfigHelper $configHelper, KernelInterface $appKernel)
    {
        $this->mailService = $mailService;
        $this->configHelper = $configHelper;
        $this->appKernel = $appKernel;
    }

    private function getBodyRenderer(): BodyRenderer
    {
        if ($this->bodyRenderer === null) {
            $root = $this->appKernel->getProjectDir();
            $loader = new FilesystemLoader($root . '/templates');
            $twig = new Environment($loader);
            $this->bodyRenderer = new BodyRenderer($twig);
        }

        return $this->bodyRenderer;

    }

    /**
     * Send an e-mail to the cluster administrator(s), as well as the supervisor of the request.
     *
     * @param AccessRequest $accessRequest
     * @return void
     */
    public function sendRequestMail(AccessRequest $accessRequest): void
    {
        $approveUrl = $this->configHelper->getParameter('ROOT_URL') . '/approve/' . $accessRequest->getId();
        $denyUrl = $this->configHelper->getParameter('ROOT_URL') . '/deny/' . $accessRequest->getId();
        $description = $accessRequest->getDescription() ?: '/';
        $accessRequest->setDescription($description);

        $mail = (new TemplatedEmail())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to($this->configHelper->getParameter('CLUSTER_ADMIN'))
            ->subject('[Alan GPU Cluster] New access request')
            ->htmlTemplate('email/request.html.twig')
            ->context([
                'request' => $accessRequest,
                'approveUrl' => $approveUrl,
                'denyUrl' => $denyUrl,
            ])
            ->priority(Email::PRIORITY_NORMAL);

        $this->getBodyRenderer()->render($mail);
        $this->mailService->sendMail($mail);

        // Send a separate mail to the supervisor
        $this->sendSupervisorMail($accessRequest);
    }

    // Could and should probably re-write this entire helper class to a more efficient one.
    public function sendSupervisorMail(AccessRequest $accessRequest): void
    {
        $mail = (new TemplatedEmail())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to($accessRequest->getSupervisorMail())
            ->subject('[Alan GPU Cluster] New access request')
            ->htmlTemplate('email/request.html.twig')
            ->context([
                'request' => $accessRequest,
                'approveUrl' => null
            ])
            ->priority(Email::PRIORITY_NORMAL);

        $this->getBodyRenderer()->render($mail);
        $this->mailService->sendMail($mail);
    }

    /**
     * Send an e-mail to the user, notifying them that their request has been approved.
     * It will include their created FreeIPA credentials.
     *
     * @param AccessRequest $accessRequest
     * @return void
     */
    public function sendApprovedMail(AccessRequest $accessRequest): void
    {
        $mail = (new TemplatedEmail())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to($accessRequest->getUserMail())
            ->subject('[Alan GPU Cluster] Access request approved')
            ->htmlTemplate('email/request_approved.html.twig')
            ->context([
                'request' => $accessRequest,
                'host' => $this->configHelper->getParameter('MASTER_HOST'),
                'ip' => $this->configHelper->getParameter('MASTER_IP')
            ])
            ->attachFromPath($accessRequest->getPrivateKey())
            ->priority(Email::PRIORITY_NORMAL);

        $this->getBodyRenderer()->render($mail);
        $this->mailService->sendMail($mail);
    }

    public function sendDeniedMail(AccessRequest $accessRequest, $reason = null): void
    {
        $mail = (new TemplatedEmail())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to($accessRequest->getUserMail())
            ->subject('[Alan GPU Cluster] Access request denied')
            ->htmlTemplate('email/request_denied.html.twig')
            ->context([
                'reason' => $reason
            ])
            ->priority(Email::PRIORITY_NORMAL);

        $this->getBodyRenderer()->render($mail);
        $this->mailService->sendMail($mail);
    }

}