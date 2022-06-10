<?php

namespace App\Filter;

use PromotionEnquiryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{


    public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface
    {
        $enquiry->setDiscountedPrice(50);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(4);
        $enquiry->setPromotionName('Black Friday half price sale');

        return $enquiry;
    }
}
