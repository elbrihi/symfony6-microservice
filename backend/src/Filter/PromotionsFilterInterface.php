<?php

namespace App\Filter;

use PromotionEnquiryInterface;

interface PromotionsFilterInterface
{
        public function apply(PromotionEnquiryInterface $enquiry): PromotionEnquiryInterface;
}
