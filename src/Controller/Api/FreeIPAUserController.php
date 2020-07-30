<?php

namespace App\Controller\Api;

use App\Service\FreeIPA\FreeIPAService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ipa", name="ipa_", methods={"GET", "POST"})
 *
 * Class FreeIPAUserController
 * @package App\Controller\Api
 */
class FreeIPAUserController extends AbstractController
{

    /**
     * @var FreeIPAService
     */
    private $ipa;

    public function __construct(FreeIPAService $ipa)
    {
        $this->ipa = $ipa;
    }

    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function checkAuth(): JsonResponse
    {
        $auth = $this->ipa->getConnection()->getAuthenticationInfo();

        return $this->json(['data' => $auth], 200);
    }

    /**
     * @Route("/find/{username}", name="find_username")
     *
     * @param string $username
     * @return JsonResponse
     * @throws \Exception
     */
    public function findByUsername(string $username): JsonResponse
    {
        $user = $this->ipa->getUser()->get($username);
        if ($user) {
            return $this->json(['data' => $user], 200);
        }

        return $this->json(['data' => 'User not found'], 200);
    }
}