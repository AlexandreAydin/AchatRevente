<?php

namespace App\Entity\Annonce\Immobilier;

use App\Repository\Annonce\Immobilier\ApartementForSaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApartementForSaleRepository::class)]
class ApartementForSale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $livingArea = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numberOfParts = null;

    #[ORM\Column(nullable: true)]
    private ?int $Floor = null;

    #[ORM\Column(nullable: true)]
    private ?int $FloorsBuilding = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ageOfBuilding = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $exterior = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $parkingSpace = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $elevator = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isFurnished = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivingArea(): ?int
    {
        return $this->livingArea;
    }

    public function setLivingArea(?int $livingArea): static
    {
        $this->livingArea = $livingArea;

        return $this;
    }

    public function getNumberOfParts(): ?string
    {
        return $this->numberOfParts;
    }

    public function setNumberOfParts(?string $numberOfParts): static
    {
        $this->numberOfParts = $numberOfParts;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->Floor;
    }

    public function setFloor(?int $Floor): static
    {
        $this->Floor = $Floor;

        return $this;
    }

    public function getFloorsBuilding(): ?int
    {
        return $this->FloorsBuilding;
    }

    public function setFloorsBuilding(?int $FloorsBuilding): static
    {
        $this->FloorsBuilding = $FloorsBuilding;

        return $this;
    }

    public function getAgeOfBuilding(): ?string
    {
        return $this->ageOfBuilding;
    }

    public function setAgeOfBuilding(?string $ageOfBuilding): static
    {
        $this->ageOfBuilding = $ageOfBuilding;

        return $this;
    }

    public function getExterior(): ?string
    {
        return $this->exterior;
    }

    public function setExterior(?string $exterior): static
    {
        $this->exterior = $exterior;

        return $this;
    }

    public function getParkingSpace(): ?string
    {
        return $this->parkingSpace;
    }

    public function setParkingSpace(?string $parkingSpace): static
    {
        $this->parkingSpace = $parkingSpace;

        return $this;
    }

    public function getElevator(): ?string
    {
        return $this->elevator;
    }

    public function setElevator(?string $elevator): static
    {
        $this->elevator = $elevator;

        return $this;
    }

    public function isIsFurnished(): ?bool
    {
        return $this->isFurnished;
    }

    public function setIsFurnished(?bool $isFurnished): static
    {
        $this->isFurnished = $isFurnished;

        return $this;
    }
}
