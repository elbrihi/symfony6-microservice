<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;

class PriceModifier implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, \PromotionEnquiryInterface $enquiry): int
    {
        // TODO: Implement modify() method.
    }
}
