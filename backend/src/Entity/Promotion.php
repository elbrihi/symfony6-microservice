<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'float')]
    private $adjusment;

    #[ORM\Column(type: 'json')]
    private $criteria = [];

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: ProductPromotion::class)]
    private $productPromotions;

    public function __construct()
    {
        $this->productPromotions = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAdjustment(): ?float
    {
        return $this->adjusment;
    }

    public function setAdjustment(float $adjusment): self
    {
        $this->adjusment = $adjusment;

        return $this;
    }
    public function setCriteria(array $criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }
    public function getCriterial(): ?array
    {
        return $this->criteria;
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
            $productPromotion->setPromotion($this);
        }

        return $this;
    }

    public function removeProductPromotion(ProductPromotion $productPromotion): self
    {
        if ($this->productPromotions->removeElement($productPromotion)) {
            // set the owning side to null (unless already changed)
            if ($productPromotion->getPromotion() === $this) {
                $productPromotion->setPromotion(null);
            }
        }

        return $this;
    }

}
