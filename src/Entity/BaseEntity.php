<?php

namespace App\Entity;

use App\Entity\Traits\IdentifierTrait;
use Ramsey\Uuid\UuidInterface;

abstract class BaseEntity
{
    use IdentifierTrait;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}