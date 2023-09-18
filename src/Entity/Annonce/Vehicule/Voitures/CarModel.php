<?php

namespace App\Entity\Annonce\Vehicule\Voitures;

use App\Entity\Annonce\Vehicule\Voitures;
use App\Repository\Annonce\Vehicule\Voitures\CarModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarModelRepository::class)]
class CarModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'carModels')]
    private ?MakeOfCar $makeOfCar = null;

    #[ORM\OneToMany(mappedBy: 'carModel', targetEntity: Voitures::class)]
    private Collection $voitures;

    public function __construct()
    {
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

    public function getMakeOfCar(): ?MakeOfCar
    {
        return $this->makeOfCar;
    }

    public function setMakeOfCar(?MakeOfCar $makeOfCar): static
    {
        $this->makeOfCar = $makeOfCar;

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
            $voiture->setCarModel($this);
        }

        return $this;
    }

    public function removeVoiture(Voitures $voiture): static
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getCarModel() === $this) {
                $voiture->setCarModel(null);
            }
        }

        return $this;
    }
}
