<?php

namespace App\Controller;

use App\Entity\AccessRequest;
use App\Form\AccessRequestApproveFormType;
use App\Form\AccessRequestDenyFormType;
use App\Repository\AccessRequestRepository;
use App\Service\Mail\MailHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestHandlerController extends AbstractController
{
    /**
     * @var AccessRequestRepository $requestRepository
     */
    private $requestRepository;

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * @var MailHelper
     */
    private $mailHelper;

    public function __construct(AccessRequestRepository $requestRepository, EntityManagerInterface $em, MailHelper $mailHelper)
    {
        $this->requestRepository = $requestRepository;
        $this->em = $em;
        $this->mailHelper = $mailHelper;
    }

    /**
     * Approve a specific request with the provided ID.
     * This will create the account in FreeIPA, then mail the user to notify them.
     * Finally it will remove the request-entry from the database.
     *
     * @Route("/approve/{id}", name="approve_request", methods={"GET", "POST"})
     * @param string $id
     * @param Request $request
     * @return Response
     */
    public function approveRequest(string $id, Request $request): Response
    {
        /** @var AccessRequest $accessRequest */
        $accessRequest = $this->requestRepository->find($id);
        if (!$accessRequest) {
            return $this->render('error/request_not_found.html.twig');
        }

        // TODO: implement FreeIPA account registration.

        $form = $this->createForm(AccessRequestApproveFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // TODO: execute linux command based on user group.
            // $group = $data['userGroup'];

            $this->mailHelper->sendApprovedMail($accessRequest);

            $this->em->remove($accessRequest);
            $this->em->flush();

            return $this->render('request/request_approved.html.twig');
        }

        return $this->render('request/request_approve.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Deny a specific request with the provided ID.
     * This will send an e-mail to the user notifying them about the denial.
     * If entered by the cluster administrator, a brief explanation will be added to the mail.
     *
     * @Route("/deny/{id}", name="deny_request", methods={"GET", "POST"})
     * @param string $id
     * @param Request $request
     * @return Response
     */
    public function denyRequest(string $id, Request $request): Response
    {
        /** @var AccessRequest $accessRequest */
        $accessRequest = $this->requestRepository->find($id);
        if (!$accessRequest) {
            return $this->render('error/request_not_found.html.twig');
        }

        // TODO: check form submit for reason. Proceed with mail send on submit
        $form = $this->createForm(AccessRequestDenyFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $reason = $data['reason'] ?: null;
            $this->mailHelper->sendDeniedMail($accessRequest, $reason);

            $this->em->remove($accessRequest);
            $this->em->flush();

            return $this->render('request/request_denied.html.twig');
        }

        return $this->render('request/request_deny.html.twig', [
            'form' => $form->createView()
        ]);
    }

}