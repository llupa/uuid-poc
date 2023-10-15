<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[Entity]
class Proof
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private ?int $id;

    #[Column(type: 'uuid_binary')]
    private ?UuidInterface $uuid;

    #[Column]
    private string $name;

    public function __construct(string $name)
    {
        $this->id = null;
        $this->uuid = Uuid::uuid7();
        $this->name = $name;
    }

    public function getUuid(bool $asString = false): string|UuidInterface
    {
        if ($asString) {
            return $this->uuid->toString();
        }

        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
