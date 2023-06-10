<?php

namespace App\Entity;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\MultiMedia;
use App\Entity\Annonce\Vehicle;
use App\Repository\ModelCarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelCarRepository::class)]
class ModelCar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:MakeCar::class,inversedBy: 'modelCars')]
    private ?MakeCar $makeCar = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'modelCar', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'modelCar', targetEntity: Vehicle::class)]
    private Collection $vehicles;

    #[ORM\OneToMany(mappedBy: 'modelCar', targetEntity: MultiMedia::class)]
    private Collection $multiMedia;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
        $this->multiMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->getName();
    }

    public function getMakeCar(): ?MakeCar
    {
        return $this->makeCar;
    }

    public function setMakeCar(?MakeCar $makeCar): self
    {
        $this->makeCar = $makeCar;

        return $this;
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
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setModelCar($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getModelCar() === $this) {
                $article->setModelCar(null);
            }
        }

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
            $vehicle->setModelCar($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): static
    {
        if ($this->vehicles->removeElement($vehicle)) {
            // set the owning side to null (unless already changed)
            if ($vehicle->getModelCar() === $this) {
                $vehicle->setModelCar(null);
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
            $multiMedium->setModelCar($this);
        }

        return $this;
    }

    public function removeMultiMedium(MultiMedia $multiMedium): static
    {
        if ($this->multiMedia->removeElement($multiMedium)) {
            // set the owning side to null (unless already changed)
            if ($multiMedium->getModelCar() === $this) {
                $multiMedium->setModelCar(null);
            }
        }

        return $this;
    }
}
