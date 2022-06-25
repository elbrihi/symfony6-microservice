<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use PromotionEnquiryInterface;

class EvenItemsMultiplier implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        if ($quantity < 2)
        {
            return $quantity *$price ;
        }
        $oddCount = $quantity%2;

        $eventCount = $quantity - $oddCount ;
        //dd((($eventCount  *$price) * $promotion->getAdjustment()) + ($oddCount + $price));
        return (($eventCount  *$price) * $promotion->getAdjustment()) + ($oddCount + $price);
    }
}
