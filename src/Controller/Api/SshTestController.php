<?php

namespace App\Controller\Api;

use App\Service\CommandExecutor\SlurmHelper;
use App\Service\ConfigHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    private SlurmHelper $slurmHelper;

    public function __construct(ConfigHelper $configHelper, SlurmHelper $slurmHelper)
    {
        parent::__construct($configHelper);
        $this->slurmHelper = $slurmHelper;
    }

    /**
     * @Route("/slurm/addgroup", name="slurm_assoc")
     * @return JsonResponse
     */
    public function addUserToSlurmGroup(): JsonResponse
    {
        $res = $this->slurmHelper->addUserToSlurmGroup('test', 'priority-users');
        return $this->json(['data' => $res], 200);
    }

    /**
     * @Route("/generate")
     * @return JsonResponse
     */
    public function generateSsh(): JsonResponse
    {
        $res = $this->slurmHelper->generateSshKey("gaetan@peinser.com", 'gaetand');
        return $this->json(['data' => $res], 200);
    }

}