<?php

namespace App\Filter;

use App\Entity\Promotion;
use PromotionEnquiryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{


    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
    {
        $enquiry->setDiscountedPrice(50);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(4);
        $enquiry->setPromotionName('Black Friday half price sale');

        return $enquiry;
    }
}
