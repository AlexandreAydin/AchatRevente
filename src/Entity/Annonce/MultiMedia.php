<?php

namespace App\Entity\Annonce;

use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Repository\Annonce\MultiMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiMediaRepository::class)]
class MultiMedia extends Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'multiMedia')]
    private ?MakeCar $makeCar = null;

    #[ORM\ManyToOne(inversedBy: 'multiMedia')]
    private ?ModelCar $modelCar = null;

    #[ORM\Column(length: 255)]
    private ?string $state = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMakeCar(): ?MakeCar
    {
        return $this->makeCar;
    }

    public function setMakeCar(?MakeCar $makeCar): static
    {
        $this->makeCar = $makeCar;

        return $this;
    }

    public function getModelCar(): ?ModelCar
    {
        return $this->modelCar;
    }

    public function setModelCar(?ModelCar $modelCar): static
    {
        $this->modelCar = $modelCar;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }
}
