<?php

namespace App\Entity\Annonce\Vehicule\Motos;

use App\Entity\Annonce\Vehicule\Motos;
use App\Repository\Annonce\Vehicule\Motos\MotoModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotoModelRepository::class)]
class MotoModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'motoModels')]
    private ?MakeOfMoto $makeOfMoto = null;

    #[ORM\OneToMany(mappedBy: 'motoModel', targetEntity: Motos::class)]
    private Collection $motos;

    public function __construct()
    {
        $this->motos = new ArrayCollection();
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

    public function getMakeOfMoto(): ?MakeOfMoto
    {
        return $this->makeOfMoto;
    }

    public function setMakeOfMoto(?MakeOfMoto $makeOfMoto): static
    {
        $this->makeOfMoto = $makeOfMoto;

        return $this;
    }

    /**
     * @return Collection<int, Motos>
     */
    public function getMotos(): Collection
    {
        return $this->motos;
    }

    public function addMoto(Motos $moto): static
    {
        if (!$this->motos->contains($moto)) {
            $this->motos->add($moto);
            $moto->setMotoModel($this);
        }

        return $this;
    }

    public function removeMoto(Motos $moto): static
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getMotoModel() === $this) {
                $moto->setMotoModel(null);
            }
        }

        return $this;
    }
}
