<?php

namespace App\Entity;

use App\Repository\AccessRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccessRequestRepository::class)
 */
class AccessRequest extends BaseEntity
{
    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $userMail;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $supervisorMail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * This field does not have to be persisted to the database.
     * @var string $generatedPassword
     */
    private $generatedPassword;

    /**
     * This field does not have to be persisted to the database.
     * @var string $userGroup
     */
    private $userGroup;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getUserMail(): ?string
    {
        return $this->userMail;
    }

    public function setUserMail(string $userMail): self
    {
        $this->userMail = $userMail;

        return $this;
    }

    public function getSupervisorMail(): ?string
    {
        return $this->supervisorMail;
    }

    public function setSupervisorMail(string $supervisorMail): self
    {
        $this->supervisorMail = $supervisorMail;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGeneratedPassword(): ?string
    {
        return $this->generatedPassword;
    }

    public function setGeneratedPassword(string $generatedPassword): void
    {
        $this->generatedPassword = $generatedPassword;
    }

    public function getUserGroup(): ?string
    {
        return $this->userGroup;
    }

    public function setUserGroup(string $userGroup): void
    {
        $this->userGroup = $userGroup;
    }
}
