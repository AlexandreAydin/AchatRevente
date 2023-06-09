<?php

namespace App\Entity\Annonce;

use App\Entity\ArticleImage;
use App\Entity\Categorie;
use App\Entity\MakeCar;
use App\Entity\ModelCar;
use App\Entity\SubCategorie;
use App\Entity\User;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $isPublic = false;

    #[ORM\Column]
    private ?bool $isDeleted = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 150)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $postCode = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleImage::class,  cascade: ['persist'], orphanRemoval: true)]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'article')]
    #[ORM\JoinColumn(nullable:true)]
    private ?MakeCar $makeCar = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?ModelCar $modelCar = null;

    #[ORM\ManyToOne(inversedBy: 'article')]
    private ?SubCategorie $subCategorie = null;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function isIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
    

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    public function setPostCode(int $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * @return Collection<int, ArticleImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ArticleImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setArticle($this);
        }

        return $this;
    }

    public function removeImage(ArticleImage $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getArticle() === $this) {
                $image->setArticle(null);
            }
        }

        return $this;
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getModelCar(): ?ModelCar
    {
        return $this->modelCar;
    }

    public function setModelCar(?ModelCar $modelCar): self
    {
        $this->modelCar = $modelCar;

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


}
