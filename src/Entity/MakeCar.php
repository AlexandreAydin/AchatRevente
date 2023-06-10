<?php

namespace App\Entity;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\MultiMedia;
use App\Entity\Annonce\Vehicle;
use App\Repository\MakeCarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MakeCarRepository::class)]
class MakeCar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\OneToMany(mappedBy: 'makeCar', targetEntity: Article::class)]
    private Collection $article;

    #[ORM\OneToMany(mappedBy: 'makeCar', targetEntity: ModelCar::class)]
    private Collection $modelCars;

    #[ORM\ManyToOne(inversedBy: 'makeCars')]
    private ?SubCategorie $subCategorie = null;

    #[ORM\OneToMany(mappedBy: 'makeCar', targetEntity: Vehicle::class)]
    private Collection $vehicles;

    #[ORM\OneToMany(mappedBy: 'makeCar', targetEntity: MultiMedia::class)]
    private Collection $multiMedia;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->modelCars = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
        $this->multiMedia = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return Collection<int, Article>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setMakeCar($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getMakeCar() === $this) {
                $article->setMakeCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ModelCar>
     */
    public function getModelCars(): Collection
    {
        return $this->modelCars;
    }

    public function addModelCar(ModelCar $modelCar): self
    {
        if (!$this->modelCars->contains($modelCar)) {
            $this->modelCars->add($modelCar);
            $modelCar->setMakeCar($this);
        }

        return $this;
    }

    public function removeModelCar(ModelCar $modelCar): self
    {
        if ($this->modelCars->removeElement($modelCar)) {
            // set the owning side to null (unless already changed)
            if ($modelCar->getMakeCar() === $this) {
                $modelCar->setMakeCar(null);
            }
        }

        return $this;
    }

    public function getSubCategorie(): ?SubCategorie
    {
        return $this->subCategorie;
    }

    public function setSubCategorie(?SubCategorie $subCategorie): static
    {
        $this->subCategorie = $subCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): static
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles->add($vehicle);
            $vehicle->setMakeCar($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): static
    {
        if ($this->vehicles->removeElement($vehicle)) {
            // set the owning side to null (unless already changed)
            if ($vehicle->getMakeCar() === $this) {
                $vehicle->setMakeCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MultiMedia>
     */
    public function getMultiMedia(): Collection
    {
        return $this->multiMedia;
    }

    public function addMultiMedium(MultiMedia $multiMedium): static
    {
        if (!$this->multiMedia->contains($multiMedium)) {
            $this->multiMedia->add($multiMedium);
            $multiMedium->setMakeCar($this);
        }

        return $this;
    }

    public function removeMultiMedium(MultiMedia $multiMedium): static
    {
        if ($this->multiMedia->removeElement($multiMedium)) {
            // set the owning side to null (unless already changed)
            if ($multiMedium->getMakeCar() === $this) {
                $multiMedium->setMakeCar(null);
            }
        }

        return $this;
    }
}
