<?php

namespace App\Service\FreeIPA;

use App\Service\ConfigHelper;
use FreeIPA\APIAccess\Connection;
use FreeIPA\APIAccess\Main;
use FreeIPA\APIAccess\User;

class FreeIPAService
{
    private $projectDir;

    /**
     * @var Main $ipa
     */
    private $ipa;

    /**
     * @var ConfigHelper $configHelper
     */
    private $configHelper;

    public function __construct(string $projectDir, ConfigHelper $configHelper)
    {
        $this->projectDir = $projectDir;
        $this->configHelper = $configHelper;
        $this->authenticate();
    }

    public function getInstance(): Main
    {
        return $this->ipa;
    }

    public function getConnection(): Connection
    {
        return $this->ipa->connection();
    }

    public function getUser(): User
    {
        return $this->ipa->user();
    }

    private function connect(): void
    {
        $host = $this->configHelper->getParameter('IPA_HOST');
        $cert = $this->projectDir . '/freeipa/ca.crt';

        $this->ipa = new Main($host, $cert);
    }

    public function authenticate(): void
    {
        $username = $this->configHelper->getParameter('IPA_ADMIN_USER');
        $password = $this->configHelper->getParameter('IPA_ADMIN_PASS');

        try {
            $this->connect();
            $this->ipa->connection()->authenticate($username, $password);
        } catch (\Exception $e) {
            die(sprintf("Failed to authenticate with FreeIPA server: %s", $e->getMessage()));
        }
    }
}