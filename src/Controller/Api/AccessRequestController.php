<?php

namespace App\Controller\Api;

use App\Entity\AccessRequest;
use App\Repository\AccessRequestRepository;
use App\Service\ConfigHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/request", name="request_", methods={"GET"})
 *
 * Class AccessRequestController
 * @package App\Controller\Api
 */
class AccessRequestController extends AbstractAPIController
{
    /**
     * @var AccessRequestRepository
     */
    private $repository;

    public function __construct(ConfigHelper $configHelper, AccessRequestRepository $requestRepository)
    {
        parent::__construct($configHelper);
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
        if (!$this->isDevEnvironment()) {
            return $this->returnForbidden();
        }

        $data = $this->repository->findAll();
        return $this->json($data, 200);
    }

    /**
     * Fetch a specific request by the provided ID and return it as JSON.
     *
     * @Route("/id/{id}", name="by_id", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        if (!$this->isDevEnvironment()) {
            return $this->returnForbidden();
        }

        /** @var AccessRequest $request */
        $request = $this->repository->find($id);
        if (!$request) {
            return $this->json(['message' => 'Request not found.'], 400);
        }

        return $this->json($request, 200);
    }

    // ...
}