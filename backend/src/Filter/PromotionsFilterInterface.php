<?php

namespace App\Filter;

use App\Entity\Promotion;
use PromotionEnquiryInterface;

interface PromotionsFilterInterface
{
        public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotion): PromotionEnquiryInterface;
}
