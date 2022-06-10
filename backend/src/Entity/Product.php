<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductPromotion::class)]
    private $productPromotions;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: ProductPromotion::class)]
    private $validTo;

    public function __construct()
    {
        $this->productPromotions = new ArrayCollection();
        $this->validTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, ProductPromotion>
     */
    public function getProductPromotions(): Collection
    {
        return $this->productPromotions;
    }

    public function addProductPromotion(ProductPromotion $productPromotion): self
    {
        if (!$this->productPromotions->contains($productPromotion)) {
            $this->productPromotions[] = $productPromotion;
            $productPromotion->setProduct($this);
        }

        return $this;
    }

    public function removeProductPromotion(ProductPromotion $productPromotion): self
    {
        if ($this->productPromotions->removeElement($productPromotion)) {
            // set the owning side to null (unless already changed)
            if ($productPromotion->getProduct() === $this) {
                $productPromotion->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductPromotion>
     */
    public function getValidTo(): Collection
    {
        return $this->validTo;
    }

    public function addValidTo(ProductPromotion $validTo): self
    {
        if (!$this->validTo->contains($validTo)) {
            $this->validTo[] = $validTo;
            $validTo->setPromotion($this);
        }

        return $this;
    }

    public function removeValidTo(ProductPromotion $validTo): self
    {
        if ($this->validTo->removeElement($validTo)) {
            // set the owning side to null (unless already changed)
            if ($validTo->getPromotion() === $this) {
                $validTo->setPromotion(null);
            }
        }

        return $this;
    }
}
