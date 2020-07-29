<?php

namespace App\Controller\Api;

use App\Entity\AccessRequest;
use App\Repository\AccessRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/request", name="request_", methods={"GET"})
 *
 * Class AccessRequestController
 * @package App\Controller\Api
 */
class AccessRequestController extends AbstractController
{
    /**
     * @var AccessRequestRepository
     */
    private $repository;

    public function __construct(AccessRequestRepository $requestRepository)
    {
        $this->repository = $requestRepository;
    }

    /**
     * Fetch all current requests and return them as a JSON array.
     *
     * @Route("/", name="all", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $data = $this->repository->findAll();
        return $this->json($data, 200);
    }

    /**
     * Fetch a specific request by the provided ID and return it as JSON.
     *
     * @Route("/{id}", name="by_id", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        /** @var AccessRequest $request */
        $request = $this->repository->find($id);
        if (!$request) {
            return $this->json(['message' => 'Request not found.'], 400);
        }

        return $this->json($request, 200);
    }

}