<?php

namespace App\Service\FreeIPA;

use App\Entity\AccessRequest;

class FreeIPAHelper
{
    /**
     * @var FreeIPAService
     */
    private $ipaService;

    public function __construct(FreeIPAService $ipaService)
    {
        $this->ipaService = $ipaService;
    }

    public function generatePassword()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, 8);
    }

    public function addUser(AccessRequest $accessRequest): bool
    {
        $data = array(
            'givenname' => $accessRequest->getFirstName(),
            'sn' => $accessRequest->getLastName(),
            'uid' => $accessRequest->getUsername(),
            'mail' => $accessRequest->getUserMail(),
            'userpassword' => $accessRequest->getGeneratedPassword()
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