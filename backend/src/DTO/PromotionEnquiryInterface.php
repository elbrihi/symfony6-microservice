<?php
//interface PromotionEnquiryInterface extends \JsonSerializable


use App\Entity\Product;

interface PromotionEnquiryInterface extends \JsonSerializable
{
        public function getProduct(): ?Product;

        public function setPromotionId(int $promotionId);

        public function setPromotionName(string $promotionName);
}
