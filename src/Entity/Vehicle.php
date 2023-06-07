<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
#[ORM\Table(name:"vehicles")]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'vehicles')] 
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Article::class)]
    private Collection $article;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: MakeCar::class, orphanRemoval:true, cascade:["persist"])]
    private Collection $makeCars;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->makeCars = new ArrayCollection();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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
            $article->setVehicle($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getVehicle() === $this) {
                $article->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MakeCar>
     */
    public function getMakeCars(): Collection
    {
        return $this->makeCars;
    }

    public function addMakeCar(MakeCar $makeCar): self
    {
        if (!$this->makeCars->contains($makeCar)) {
            $this->makeCars->add($makeCar);
            $makeCar->setVehicle($this);
        }

        return $this;
    }

    public function removeMakeCar(MakeCar $makeCar): self
    {
        if ($this->makeCars->removeElement($makeCar)) {
            // set the owning side to null (unless already changed)
            if ($makeCar->getVehicle() === $this) {
                $makeCar->setVehicle(null);
            }
        }

        return $this;
    }

}
