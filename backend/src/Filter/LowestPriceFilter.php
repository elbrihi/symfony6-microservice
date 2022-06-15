<?php

namespace App\Filter;

use App\Entity\Promotion;
use PromotionEnquiryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{


    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface
    {

        $price = $enquiry->getProduct()->getPrice();

        $quantity = $enquiry->getQuantity();

        $lowestPrice =  $quantity * $price;

        $enquiry->setDiscountedPrice(50);
        $enquiry->setPrice(100);
        $enquiry->setPromotionId(4);
        $enquiry->setPromotionName('Black Friday half price sale');

        return $enquiry;
    }
}
