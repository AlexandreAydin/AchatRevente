<?php

namespace App\Entity\Annonce;

use App\Entity\Annonce\Categorie;
use App\Repository\Annonce\SubCategorieRepository;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'subCategories')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'subCategorie', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\ManyToMany(targetEntity: \App\Entity\Annonce\Immobilier\Categorie::class, inversedBy: 'subCategories')]
    #[ORM\JoinTable(name: 'sub_categorie_categorie')]
    private Collection $categories;


    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->categories = new ArrayCollection();
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
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setSubCategorie($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSubCategorie() === $this) {
                $article->setSubCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, \App\Entity\Annonce\Immobilier\Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(\App\Entity\Annonce\Immobilier\Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setSubCategorie($this);
        }

        return $this;
    }

    public function removeCategory(\App\Entity\Annonce\Immobilier\Categorie $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getSubCategorie() === $this) {
                $category->setSubCategorie(null);
            }
        }

        return $this;
    }


}
