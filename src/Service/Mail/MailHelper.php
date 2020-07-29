<?php

namespace App\Service\Mail;

use App\Entity\AccessRequest;
use App\Service\ConfigHelper;
use Symfony\Component\Mime\Email;

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

    public function __construct(MailService $mailService, ConfigHelper $configHelper)
    {
        $this->mailService = $mailService;
        $this->configHelper = $configHelper;
    }

    /**
     * Send an e-mail to the cluster administrator(s), as well as the supervisor of the request.
     *
     * @param AccessRequest $accessRequest
     * @return void
     */
    public function sendRequestMail(AccessRequest $accessRequest): void
    {
        $adminEmails = ['gaetan1995@gmail.com'];
        $description = $accessRequest->getDescription() ?: '/';

        $mail = (new Email())
            ->from($accessRequest->getUserMail())
            ->to(...$adminEmails)
            ->cc($accessRequest->getSupervisorMail())
            ->subject('[Alan] Access request')
            // Some nasty in-line HTML incoming
            ->html(
                "<style lang='css'>.bold { font-weight: 700 !important; }</style>" .
                "<h3>Alan access request</h3>" .
                "<p><span class='bold'>Requested by:</span><br />{$accessRequest->getFirstName()} {$accessRequest->getLastName()}</p>" .
                "<p><span class='bold'>Email:</span><br />{$accessRequest->getUserMail()}</p>" .
                "<p><span class='bold'>Supervisor:</span><br />{$accessRequest->getSupervisorMail()}</p>" .
                "<p><span class='bold'>Description:</span><br />{$description}</p>" .
                "<p>To approve this request, go to <a href='{$this->configHelper->getParameter('ROOT_URL')}/approve/{$accessRequest->getId()}'>" .
                "{$this->configHelper->getParameter('ROOT_URL')}/approve/{$accessRequest->getId()}</a>."
            )
            ->priority(Email::PRIORITY_NORMAL);

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
        $ssh = 'ssh-rsa AAAABBBBCCCC jdoe@MY-COMPUTER';

        $mail = (new Email())
            ->from($this->configHelper->getParameter('ROOT_MAIL'))
            ->to($accessRequest->getUserMail())
            ->subject('[Alan] Access requested approved')
            ->html(
                "<style lang='css'>.bold { font-weight: 700 !important; }</style>" .
                "<p>Dear<br />Your request to use the Alan Cluster has been approved.</p>" .
                "<p class='bold'>Your credentials</p>" .
                "<p><span class='bold'>Username:</span><br />{$username}</p>" .
                "<p><span class='bold'>Password:</span><br >{$password}</p>" .
                "<span class='bold'>Public SSH key:</span><br /><code>{$ssh}</code>")
            ->priority(Email::PRIORITY_NORMAL);

        $this->mailService->sendMail($mail);
    }

}