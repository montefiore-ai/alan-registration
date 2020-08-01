<?php

namespace App\Service\FreeIPA;

use App\Entity\AccessRequest;
use DateTime;

class FreeIPAHelper
{
    /**
     * @var FreeIPAService
     */
    private $ipaService;

    private $projectDir;

    public function __construct(string $projectDir, FreeIPAService $ipaService)
    {
        $this->ipaService = $ipaService;
        $this->projectDir = $projectDir;
    }

    public function generatePassword()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, 8);
    }

    /**
     * Checks the user group that the user has been approved for and modify the DateTime object accordingly.
     *
     * !! NOTE !! Please note that the values in the switch-block MUST match the values set in src/Form/AccessRequestApproveFormType.php
     *
     * @param string $group
     * @return string|null
     */
    private function getExpirationValue(string $group): ?string
    {
        switch ($group) {
            case 'students':
                $modifier = '+1 years';
                break;
            default:
                $modifier = null;
        }

        return $modifier;
    }

    public function setExpirationDate(string $modifier = null): ?string
    {
        if ($modifier) {
            $date = new DateTime();
            $date->modify($modifier);
            $date = $date->format('YmdHis') . 'Z';
        } else {
            $date = null;
        }

        return $date;
    }

    /**
     * Add a new user with given credentials to the FreeIPA server.
     *
     * @param AccessRequest $accessRequest
     * @return bool
     */
    public function addUser(AccessRequest $accessRequest): bool
    {
        $date = $this->setExpirationDate($this->getExpirationValue($accessRequest->getUserGroup()));

        $data = array(
            'givenname' => $accessRequest->getFirstName(),
            'sn' => $accessRequest->getLastName(),
            'uid' => $accessRequest->getUsername(),
            'mail' => $accessRequest->getUserMail(),
            'userpassword' => $accessRequest->getGeneratedPassword(),
            'krbprincipalexpiration' => $date,
            'ipasshpubkey' => file_get_contents($this->projectDir . '/keys/' . $accessRequest->getUsername() . '.pub')
        );

        try {
            $user = $this->ipaService->getUser()->add($data);
            if ($user) {
                return true;
            }
        } catch (\Exception $e) {
            die(sprintf('Failed to add user to FreeIPA: %s', $e->getMessage()));
        }

        return false;
    }

}