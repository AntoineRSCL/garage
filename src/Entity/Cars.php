<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 255)]
    private ?string $urlBrand = null;

    #[ORM\OneToMany(mappedBy: 'cars', targetEntity: Images::class, orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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

    public function getUrlBrand(): ?string
    {
        return $this->urlBrand;
    }

    public function setUrlBrand(string $urlBrand): static
    {
        $this->urlBrand = $urlBrand;

        return $this;
    }

    /**
     * Intialise les images des marques
     *
     * @return void
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function initalizeUrlBrand(): void
    {
        if($this->brand == "Toyota")
        {
            $this->urlBrand = "https://www.garagepieters.be/wp-content/uploads/2017/05/Toyota-Logo-Free-Download-PNG.png";
        }else if($this->brand == "Porsche"){
            $this->urlBrand = "https://pngimg.com/uploads/porsche_logo/porsche_logo_PNG1.png";
        }else if($this->brand == "Volkswagen"){
            $this->urlBrand = "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Volkswagen_logo_2019.svg/2048px-Volkswagen_logo_2019.svg.png";
        }else if($this->brand == "BMW"){
            $this->urlBrand = "https://seeklogo.com/images/B/bmw-logo-248C3D90E6-seeklogo.com.png";
        }else if($this->brand == "Alfa Romeo"){
            $this->urlBrand = "https://upload.wikimedia.org/wikipedia/fr/thumb/d/d7/Logo_Alfa_Romeo.svg/1024px-Logo_Alfa_Romeo.svg.png";
        }else if($this->brand == "Ford"){
            $this->urlBrand = "https://upload.wikimedia.org/wikipedia/commons/c/c7/Ford-Motor-Company-Logo.png";
        }else if($this->brand == "Lamborghini"){
            $this->urlBrand = "https://upload.wikimedia.org/wikipedia/fr/thumb/1/1d/Lamborghini-Logo.svg/672px-Lamborghini-Logo.svg.png";
        }else if($this->brand == "Audi"){
            $this->urlBrand = "https://upload.wikimedia.org/wikipedia/fr/thumb/1/15/Audi_logo.svg/1280px-Audi_logo.svg.png";
        }
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCars($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCars() === $this) {
                $image->setCars(null);
            }
        }

        return $this;
    }



    
}
