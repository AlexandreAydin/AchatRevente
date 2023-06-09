<?php

namespace App\Entity;

use App\Entity\Annonce\Article;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ORM\Table(name:"categories")]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: SubCategorie::class)]
    private Collection $subCategories;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->subCategories = new ArrayCollection();
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
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategorie($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCategorie() === $this) {
                $article->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubCategorie>
     */
    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(SubCategorie $subCategory): static
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories->add($subCategory);
            $subCategory->setCategorie($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategorie $subCategory): static
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getCategorie() === $this) {
                $subCategory->setCategorie(null);
            }
        }

        return $this;
    }
}
