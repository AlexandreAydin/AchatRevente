<?php

namespace App\Entity\Annonce\Immobilier;

use App\Repository\Annonce\Immobilier\LandForSaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LandForSaleRepository::class)]
class LandForSale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $buildingLand = null;

    #[ORM\Column(nullable: true)]
    private ?int $livingArea = null;

    #[ORM\Column(nullable: true)]
    private ?int $surfaceArea = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildingLand(): ?string
    {
        return $this->buildingLand;
    }

    public function setBuildingLand(?string $buildingLand): static
    {
        $this->buildingLand = $buildingLand;

        return $this;
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

    public function getSurfaceArea(): ?int
    {
        return $this->surfaceArea;
    }

    public function setSurfaceArea(?int $surfaceArea): static
    {
        $this->surfaceArea = $surfaceArea;

        return $this;
    }

  
}
