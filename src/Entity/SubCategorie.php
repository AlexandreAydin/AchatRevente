<?php

namespace App\Entity;

use App\Entity\Annonce\Article;
use App\Repository\SubCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubCategorieRepository::class)]
class SubCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'subCategories')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'subCategorie', targetEntity: Article::class)]
    private Collection $article;

    #[ORM\OneToMany(mappedBy: 'subCategorie', targetEntity: MakeCar::class)]
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
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

    public function addArticle(Article $article): static
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setSubCategorie($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSubCategorie() === $this) {
                $article->setSubCategorie(null);
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

    public function addMakeCar(MakeCar $makeCar): static
    {
        if (!$this->makeCars->contains($makeCar)) {
            $this->makeCars->add($makeCar);
            $makeCar->setSubCategorie($this);
        }

        return $this;
    }

    public function removeMakeCar(MakeCar $makeCar): static
    {
        if ($this->makeCars->removeElement($makeCar)) {
            // set the owning side to null (unless already changed)
            if ($makeCar->getSubCategorie() === $this) {
                $makeCar->setSubCategorie(null);
            }
        }

        return $this;
    }
}
