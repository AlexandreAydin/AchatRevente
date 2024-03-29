<?php

namespace App\Entity\Annonce;


use App\Entity\Annonce\Immobilier\ApartementForSale;
use App\Entity\Annonce\Vehicule\Caravanning;
use App\Entity\Annonce\Vehicule\Motos;
use App\Entity\Annonce\Vehicule\Voitures;
use App\Entity\ArticleImage;
use App\Entity\Annonce\Categorie;
use App\Entity\Annonce\Immobilier\ApartementRental;
use App\Entity\Annonce\Immobilier\HouseForSale;
use App\Entity\Annonce\Immobilier\HouseRental;
use App\Entity\Annonce\Immobilier\LandForSale;
use App\Entity\Annonce\Vehicule\Camions;
use App\Entity\User;
use App\Repository\Annonce\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"vehicule" = "Vehicule", "multimedia" = "Multimedia"})
 */
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

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: ArticleImage::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $images;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Categorie $categorie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Assert\NotBlank(groups: ["Voitures"])]
    private ?Voitures $voitures = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?SubCategorie $subCategorie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Motos $motos = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Caravanning $caravanning = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Camions $camions = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?\App\Entity\Annonce\Immobilier\Categorie $immobilierCategorie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApartementForSale $apartmentForSale = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ApartementRental $apartementRental = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?HouseForSale $houseForSale = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?HouseRental $houseRental = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?LandForSale $landForSale = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->images = new ArrayCollection();
        // $this->apartmentForSale = new ApartementForSale();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getVoitures(): ?Voitures
    {
        return $this->voitures;
    }

    public function setVoitures(?Voitures $voitures): static
    {
        $this->voitures = $voitures;

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

    public function getMotos(): ?Motos
    {
        return $this->motos;
    }

    public function setMotos(?Motos $motos): static
    {
        $this->motos = $motos;

        return $this;
    }

    public function getCaravanning(): ?Caravanning
    {
        return $this->caravanning;
    }

    public function setCaravanning(?Caravanning $caravanning): static
    {
        $this->caravanning = $caravanning;

        return $this;
    }

    public function getCamions(): ?Camions
    {
        return $this->camions;
    }

    public function setCamions(?Camions $camions): static
    {
        $this->camions = $camions;

        return $this;
    }

    public function getImmobilierCategorie(): ?\App\Entity\Annonce\Immobilier\Categorie
    {
        return $this->immobilierCategorie;
    }

    public function setImmobilierCategorie(?\App\Entity\Annonce\Immobilier\Categorie $immobilierCategorie): static
    {
        $this->immobilierCategorie = $immobilierCategorie;

        return $this;
    }

    public function getApartmentForSale(): ?ApartementForSale
    {
        return $this->apartmentForSale;
    }

    public function setApartmentForSale(?ApartementForSale $apartmentForSale): static
    {
        $this->apartmentForSale = $apartmentForSale;

        return $this;
    }


    public function getApartementRental(): ?ApartementRental
    {
        return $this->apartementRental;
    }

    public function setApartementRental(?ApartementRental $apartementRental): static
    {
        $this->apartementRental = $apartementRental;

        return $this;
    }

    public function getHouseForSale(): ?HouseForSale
    {
        return $this->houseForSale;
    }

    public function setHouseForSale(?HouseForSale $houseForSale): static
    {
        $this->houseForSale = $houseForSale;

        return $this;
    }

    public function getHouseRental(): ?HouseRental
    {
        return $this->houseRental;
    }

    public function setHouseRental(?HouseRental $houseRental): static
    {
        $this->houseRental = $houseRental;

        return $this;
    }

    public function getLandForSale(): ?LandForSale
    {
        return $this->landForSale;
    }

    public function setLandForSale(?LandForSale $landForSale): static
    {
        $this->landForSale = $landForSale;

        return $this;
    }

}
