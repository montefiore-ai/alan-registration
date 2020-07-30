<?php

namespace App\Controller;

use App\Entity\AccessRequest;
use App\Form\AccessRequestFormType;
use App\Repository\AccessRequestRepository;
use App\Service\Mail\MailHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{
    /**
     * Main entry point of the web application.
     * Responsible for handling form initialization as well as the submitted data.
     *
     * @Route("/", name="register", methods={"GET", "POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param MailHelper $mailHelper
     * @param AccessRequestRepository $requestRepository
     * @return Response
     */
    public function register(EntityManagerInterface $em, Request $request, MailHelper $mailHelper, AccessRequestRepository $requestRepository): Response
    {
        $accessRequest = new AccessRequest();
        $form = $this->createForm(AccessRequestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $userMail = $data['userMail'];
            $supervisorMail = $data['supervisorMail'];
            $description = $data['description'];

            // Execute some checks before continuing.
            if ($userMail === $supervisorMail) {
                $form->addError(new FormError('The e-mail of the supervisor can not be the same as your own.'));
            }
            if ($requestRepository->findBy(['userMail' => $userMail])) {
                $form->addError(new FormError('You already have a pending access request. Please wait for this to be handled.'));
            }

            if ($form->isValid()) {
                $accessRequest->setFirstName($firstName);
                $accessRequest->setLastName($lastName);
                $accessRequest->setUserMail($userMail);
                $accessRequest->setSupervisorMail($supervisorMail);
                if ($description) {
                    $accessRequest->setDescription($description);
                }

                $em->persist($accessRequest);
                $em->flush();

                $mailHelper->sendRequestMail($accessRequest);

                return $this->redirectToRoute(
                    'register_completed', [
                    'completed' => true
                ]);
            }
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors()
        ]);
    }

    /**
     * Called when the user submits a valid registration.
     *
     * @Route("/register", name="register_completed", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function finishRegistration(Request $request): Response
    {
        if ($request->get('completed')) {
            return $this->render('request/request_submitted.html.twig');
        }

        return $this->redirectToRoute('register');
    }

}