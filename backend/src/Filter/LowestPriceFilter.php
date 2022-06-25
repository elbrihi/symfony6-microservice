<?php

namespace App\Filter;

use App\DTO\PriceEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifier\Factory\priceModifierFactoryInterface;

class LowestPriceFilter implements PriceFilterInterface
{

    public function  __construct(private priceModifierFactoryInterface $priceModifierFactory)
    {
    }

    public function apply(PriceEnquiryInterface $enquiry, Promotion ...$promotions): PriceEnquiryInterface
    {

        $price = $enquiry->getProduct()->getPrice();
        $enquiry->setPrice($price);
        $quantity = $enquiry->getQuantity();

        foreach ($promotions as $promotion)
        {

            $priceModifier = $this->priceModifierFactory->create($promotion->getType());

            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

            $enquiry->setDiscountedPrice($modifiedPrice);
            $enquiry->setPromotionId(3);
          //  dump($promotion);
            $enquiry->setPromotionName($promotion->getName());

            $lowestPrice = $modifiedPrice;

        }
        return $enquiry;
    }
}
