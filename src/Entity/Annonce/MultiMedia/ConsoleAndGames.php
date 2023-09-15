<?php

namespace App\Entity\Annonce\MultiMedia;

use App\Repository\Annonce\MultiMedia\ConsoleAndGamesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsoleAndGamesRepository::class)]
class ConsoleAndGames
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $typeConsole = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $etat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeConsole(): ?string
    {
        return $this->typeConsole;
    }

    public function setTypeConsole(string $typeConsole): static
    {
        $this->typeConsole = $typeConsole;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }
}
