<?php

namespace App\Entity\Annonce\Vehicule\Voitures;

use App\Entity\Annonce\Vehicule\Voitures;
use App\Repository\Annonce\Vehicule\Voitures\MakeOfCarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MakeOfCarRepository::class)]
class MakeOfCar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'makeOfCar', targetEntity: CarModel::class)]
    private Collection $carModels;

    #[ORM\OneToMany(mappedBy: 'makeOfCar', targetEntity: Voitures::class)]
    private Collection $voitures;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->carModels = new ArrayCollection();
        $this->voitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CarModel>
     */
    public function getCarModels(): Collection
    {
        return $this->carModels;
    }

    public function addCarModel(CarModel $carModel): static
    {
        if (!$this->carModels->contains($carModel)) {
            $this->carModels->add($carModel);
            $carModel->setMakeOfCar($this);
        }

        return $this;
    }

    public function removeCarModel(CarModel $carModel): static
    {
        if ($this->carModels->removeElement($carModel)) {
            // set the owning side to null (unless already changed)
            if ($carModel->getMakeOfCar() === $this) {
                $carModel->setMakeOfCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Voitures>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voitures $voiture): static
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setMakeOfCar($this);
        }

        return $this;
    }

    public function removeVoiture(Voitures $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getMakeOfCar() === $this) {
                $voiture->setMakeOfCar(null);
            }
        }

        return $this;
    }
}
