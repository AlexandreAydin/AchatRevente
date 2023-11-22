<?php

namespace App\Entity;

class SearchArticle
{
    private ?int $minPrice = null;

    private ?int $maxPrice = null;

    private ?int $minMileage = null;

    private ?int $maxMileage = null;
   
    
    /**
     * Undocumented variable
     *
     * @var Categorie[]
     */
    private array $categories = [];

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): self
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinMileage(): ?int
    {
        return $this->minMileage;
    }

    public function setMinMileage(?int $minMileage): self
    {
        $this->minMileage = $minMileage;

        return $this;
    }

    public function getMaxMileage(): ?int
    {
        return $this->maxMileage;
    }

    public function setMaxMileage(?int $maxMileage): self
    {
        $this->maxMileage = $maxMileage;

        return $this;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(?array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
