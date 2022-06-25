<?php
namespace App\DTO ;

use App\Entity\Product;
use App\Entity\Promotion;
use PromotionEnquiryInterface;

interface PriceEnquiryInterface extends PromotionEnquiryInterface
{
    public function setPrice(int $price);

    public function setDiscountedPrice(int $discountedPrice);

    public function getQuantity(): ?int;

}
