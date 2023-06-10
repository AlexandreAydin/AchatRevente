<?php

namespace App\Entity\Annonce;

use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Repository\Annonce\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle extends Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    private ?MakeCar $makeCar = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    private ?ModelCar $modelCar = null;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        parent::__construct();
        $this->articles = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setVehicle($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getVehicle() === $this) {
                $article->setVehicle(null);
            }
        }

        return $this;
    }

}
