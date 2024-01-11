<?php

declare(strict_types=1);

namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait Timestapable{

    #[\DateTimeInterface]
    #[ORM\Column(type:"datetime")]
    private \DateTimeInterface $createdAt;

    #[\DateTimeInterface]
    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $updatedAt;

    
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): Timestapable
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}