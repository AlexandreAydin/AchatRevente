<?php

namespace App\Entity\Annonce\Vehicule;

use App\Entity\Annonce\Vehicule\Voitures\CarModel;
use App\Entity\Annonce\Vehicule\Voitures\MakeOfCar;
use App\Repository\Annonce\Vehicule\VoituresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoituresRepository::class)]
class Voitures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?MakeOfCar $makeOfCar = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    private ?CarModel $carModel = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?int $Annee = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $carburant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gearbox = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicleType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numberOfSeats = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fiscalPower = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $driverLicense = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $mileage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numberOfPlaces = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?int
    {
        return $this->Annee;
    }

    public function setAnnee(int $Annee): static
    {
        $this->Annee = $Annee;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): static
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getMakeOfCar(): ?MakeOfCar
    {
        return $this->makeOfCar;
    }

    public function setMakeOfCar(?MakeOfCar $makeOfCar): static
    {
        $this->makeOfCar = $makeOfCar;

        return $this;
    }

    public function getCarModel(): ?CarModel
    {
        return $this->carModel;
    }

    public function setCarModel(?CarModel $carModel): static
    {
        $this->carModel = $carModel;

        return $this;
    }

    public function getGearbox(): ?string
    {
        return $this->gearbox;
    }

    public function setGearbox(?string $gearbox): static
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getVehicleType(): ?string
    {
        return $this->vehicleType;
    }

    public function setVehicleType(?string $VehicleType): static
    {
        $this->vehicleType = $VehicleType;

        return $this;
    }

    public function getNumberOfSeats(): ?string
    {
        return $this->numberOfSeats;
    }

    public function setNumberOfSeats(?string $numberOfSeats): static
    {
        $this->numberOfSeats = $numberOfSeats;

        return $this;
    }

    public function getFiscalPower(): ?string
    {
        return $this->fiscalPower;
    }

    public function setFiscalPower(?string $fiscalPower): static
    {
        $this->fiscalPower = $fiscalPower;

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

    public function getMileage(): ?string
    {
        return $this->mileage;
    }

    public function setMileage(?string $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getNumberOfPlaces(): ?string
    {
        return $this->numberOfPlaces;
    }

    public function setNumberOfPlaces(?string $numberOfPlaces): static
    {
        $this->numberOfPlaces = $numberOfPlaces;

        return $this;
    }
}
