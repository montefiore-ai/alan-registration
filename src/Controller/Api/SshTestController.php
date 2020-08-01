<?php

namespace App\Controller\Api;

use App\Service\CommandExecutor\SlurmHelper;
use App\Service\ConfigHelper;
use App\Service\FreeIPA\FreeIPAHelper;
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

}