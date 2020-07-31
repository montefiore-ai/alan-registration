<?php

namespace App\Controller\Api;

use App\Service\ConfigHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractAPIController extends AbstractController
{
    /**
     * @var ConfigHelper
     */
    private $configHelper;

    public function __construct(ConfigHelper $configHelper)
    {
        $this->configHelper = $configHelper;
    }

    /**
     * Only expose the API when the environment is set to development.
     * This is to prevent users to find out the UUID of their request and approve it themselves.
     *
     * @return bool
     */
    protected function isDevEnvironment(): bool
    {
        return ($this->configHelper->getParameter('APP_ENV') === 'dev');
    }

    // Just makes my life a bit easier
    public function returnForbidden(): JsonResponse
    {
        return new JsonResponse(['data' => 'Access forbidden.'], 403);
    }

    // ...

}