<?php

namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;

/**
 * A small service to load and retrieve configuration parameters for easy and fast access.
 *
 * Class ConfigHelper
 * @package App\Service
 */
class ConfigHelper
{
    public function __construct()
    {
        $this->loadConfig();
    }

    public function loadConfig(): void
    {
        $env = new Dotenv();
        $env->load(__DIR__ . '/../../.env.local');
    }

    public function getParameter(string $param): string
    {
        return $_ENV[$param];
    }

}