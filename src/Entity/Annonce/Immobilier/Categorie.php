<?php

namespace App\Entity\Annonce\Immobilier;

use App\Entity\Annonce\Article;
use App\Entity\Annonce\SubCategorie;
use App\Repository\Annonce\Immobilier\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?SubCategorie $subCategorie = null;

    #[ORM\OneToMany(mappedBy: 'immobilierCategorie', targetEntity: Article::class)]
    private Collection $articles;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->articles = new ArrayCollection();
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
            $article->setImmobilierCategorie($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getImmobilierCategorie() === $this) {
                $article->setImmobilierCategorie(null);
            }
        }

        return $this;
    }
}
