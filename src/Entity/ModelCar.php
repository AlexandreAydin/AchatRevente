<?php

namespace App\Entity;

use App\Entity\Annonce\Article;
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

    public function __construct()
    {
        $this->articles = new ArrayCollection();
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
}
