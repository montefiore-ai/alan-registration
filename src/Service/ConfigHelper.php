<?php

namespace App\Service;

use Symfony\Component\Dotenv\Dotenv;

/**
 * A small helper class to load and retrieve configuration parameters for easy and fast access.
 *
 * Class ConfigHelper
 * @package App\Service
 */
class ConfigHelper
{
    private $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->loadConfig();
    }

    public function loadConfig(): void
    {
        $env = new Dotenv();
        $env->load($this->projectDir . '/.env.local');
    }

    public function getParameter(string $param): string
    {
        return $_ENV[$param];
    }

}