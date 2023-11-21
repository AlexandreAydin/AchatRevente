<?php

namespace App\Entity\Annonce\Vehicule;

use App\Entity\Annonce\Vehicule\Motos\MakeOfMoto;
use App\Entity\Annonce\Vehicule\Motos\MotoModel;
use App\Repository\Annonce\Vehicule\MotosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotosRepository::class)]
class Motos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $annee = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $driverLicense = null;

    #[ORM\Column(nullable: true)]
    private ?int $mileage = null;

    #[ORM\Column(type:"string", length:255, nullable:true)]
    private ?string $color = null;
    
    #[ORM\ManyToOne(inversedBy: 'motos')]
    private ?MakeOfMoto $makeOfMoto = null;

    #[ORM\ManyToOne(inversedBy: 'motos')]
    private ?MotoModel $motoModel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDriverLicense(): ?string
    {
        return $this->driverLicense;
    }

    public function setDriverLicense(?string $driverLicense): static
    {
        $this->driverLicense = $driverLicense;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(?int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getMakeOfMoto(): ?MakeOfMoto
    {
        return $this->makeOfMoto;
    }

    public function setMakeOfMoto(?MakeOfMoto $makeOfMoto): static
    {
        $this->makeOfMoto = $makeOfMoto;

        return $this;
    }

    public function getMotoModel(): ?MotoModel
    {
        return $this->motoModel;
    }

    public function setMotoModel(?MotoModel $motoModel): static
    {
        $this->motoModel = $motoModel;

        return $this;
    }
}
