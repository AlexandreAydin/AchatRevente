<?php

namespace App\Entity\Annonce\Vehicule\Motos;

use App\Entity\Annonce\Vehicule\Motos;
use App\Repository\Annonce\Vehicule\Motos\MakeOfMotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MakeOfMotoRepository::class)]
class MakeOfMoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'makeOfMoto', targetEntity: Motos::class)]
    private Collection $motos;

    #[ORM\OneToMany(mappedBy: 'makeOfMoto', targetEntity: MotoModel::class)]
    private Collection $motoModels;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->motos = new ArrayCollection();
        $this->motoModels = new ArrayCollection();
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
            $moto->setMakeOfMoto($this);
        }

        return $this;
    }

    public function removeMoto(Motos $moto): static
    {
        if ($this->motos->removeElement($moto)) {
            // set the owning side to null (unless already changed)
            if ($moto->getMakeOfMoto() === $this) {
                $moto->setMakeOfMoto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MotoModel>
     */
    public function getMotoModels(): Collection
    {
        return $this->motoModels;
    }

    public function addMotoModel(MotoModel $motoModel): static
    {
        if (!$this->motoModels->contains($motoModel)) {
            $this->motoModels->add($motoModel);
            $motoModel->setMakeOfMoto($this);
        }

        return $this;
    }

    public function removeMotoModel(MotoModel $motoModel): static
    {
        if ($this->motoModels->removeElement($motoModel)) {
            // set the owning side to null (unless already changed)
            if ($motoModel->getMakeOfMoto() === $this) {
                $motoModel->setMakeOfMoto(null);
            }
        }

        return $this;
    }
}
