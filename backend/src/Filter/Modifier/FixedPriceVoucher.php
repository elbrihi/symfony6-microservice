<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use PromotionEnquiryInterface;

class FixedPriceVoucher implements PriceModifierInterface
{

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {

        if (!($enquiry->getVoucherCode() === $promotion->getCriteria()['code'])) {

            return $price * $quantity;
        }
        return $promotion->getAdjustment() * $quantity;
    }
}
