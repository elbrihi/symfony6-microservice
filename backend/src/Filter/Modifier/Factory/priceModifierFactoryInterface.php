<?php

namespace App\Filter\Modifier\Factory;

use App\Filter\Modifier\PriceModifierInterface;

interface priceModifierFactoryInterface
{
    const PRICE_MODIFIER_NAMESPACE = "App\Filter\Modifier\\";
    public function create(string $modifyType): PriceModifierInterface;
}
