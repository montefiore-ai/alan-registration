<?php

namespace App\Service\Mail;

use App\Entity\AccessRequest;
use App\Service\ConfigHelper;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
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
        $adminEmails = ['gaetan@peinser.com'];
        $approveUrl = $this->configHelper->getParameter('ROOT_URL') . '/approve/' . $accessRequest->getId();
        $denyUrl = $this->configHelper->getParameter('ROOT_URL') . '/deny/' . $accessRequest->getId();

        $description = $accessRequest->getDescription() ?: '/';
        $accessRequest->setDescription($description);

        $mail = (new TemplatedEmail())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to(...$adminEmails)
            ->cc('gaetan1995@gmail.com')
            ->subject('Test')
            ->htmlTemplate('email/request.html.twig')
            ->context([
                'request' => $accessRequest,
                'approveUrl' => $approveUrl,
                'denyUrl' => $denyUrl
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
        // TODO: fetch FreeIPA credentials (username, generated password, ...) and add to mail.
        $username = 'jdoe';
        $password = 'Dr58D4d';

        $mail = (new TemplatedEmail())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to($accessRequest->getUserMail())
            ->subject('[Alan] Access requested approved')
            ->htmlTemplate('email/request_approved.html.twig')
            ->context([
                'username' => $username,
                'password' => $password
            ])
            ->priority(Email::PRIORITY_NORMAL);

        $this->getBodyRenderer()->render($mail);
        $this->mailService->sendMail($mail);
    }

}