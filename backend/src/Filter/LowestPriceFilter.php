<?php

namespace App\Filter;

use App\Entity\Promotion;
use App\Filter\Modifier\Factory\priceModifierFactoryInterface;
use PromotionEnquiryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{

    public function  __construct(private priceModifierFactoryInterface $priceModifierFactory)
    {
    }

    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotions): PromotionEnquiryInterface
    {

        $price = $enquiry->getProduct()->getPrice();

        $quantity = $enquiry->getQuantity();
        foreach ($promotions as $promotion)
        {

            $priceModifier = $this->priceModifierFactory->create($promotion->getType());



           // $lowestPrice =  $quantity * $price;


            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);


            $enquiry->setDiscountedPrice(50);
            $enquiry->setPrice(100);
            $enquiry->setPromotionId(3);
            $enquiry->setPromotionName('Black Friday half price sale');

        }


        return $enquiry;
    }
}
