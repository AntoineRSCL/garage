<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarsRepository;

#[ORM\Entity(repositoryClass: CarsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Cars
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $coverImage = null;

    #[ORM\Column]
    private ?float $kilometers = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?int $owners = null;

    #[ORM\Column]
    private ?float $engineCylinder = null;

    #[ORM\Column]
    private ?int $power = null;

    #[ORM\Column(length: 255)]
    private ?string $fuel = null;

    #[ORM\Column]
    private ?int $releaseYear = null;

    #[ORM\Column(length: 30)]
    private ?string $transmission = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $options = null;

    #[ORM\Column(length: 255)]
    private ?string $slugBrand = null;

    #[ORM\Column(length: 255)]
    private ?string $slugModel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): static
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function getKilometers(): ?float
    {
        return $this->kilometers;
    }

    public function setKilometers(float $kilometers): static
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOwners(): ?int
    {
        return $this->owners;
    }

    public function setOwners(int $owners): static
    {
        $this->owners = $owners;

        return $this;
    }

    public function getEngineCylinder(): ?float
    {
        return $this->engineCylinder;
    }

    public function setEngineCylinder(float $engineCylinder): static
    {
        $this->engineCylinder = $engineCylinder;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(int $releaseYear): static
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getSlugBrand(): ?string
    {
        return $this->slugBrand;
    }

    public function setSlugBrand(string $slugBrand): static
    {
        $this->slugBrand = $slugBrand;

        return $this;
    }

    public function getSlugModel(): ?string
    {
        return $this->slugModel;
    }

    public function setSlugModel(string $slugModel): static
    {
        $this->slugModel = $slugModel;

        return $this;
    }

    /**
     * Permet d'initialiser les slugs automatiquement
     *
     * @return void
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function iniatializeSlugs(): void 
    {
        $slugify = new Slugify();
        if(empty($this->slugBrand))
        {
            $this->slugBrand = $slugify->slugify($this->brand);
        }
        if(empty($this->slugModel))
        {
            $this->slugModel = $slugify->slugify($this->model);
        }
    }
}
