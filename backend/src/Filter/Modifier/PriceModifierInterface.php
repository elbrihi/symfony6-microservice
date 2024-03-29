<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use PromotionEnquiryInterface;


interface PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry):int;

}
