<?php

namespace App\Filter\Modifier\Factory;

use App\Filter\Modifier\PriceModifierInterface;
use Prophecy\Exception\Doubler\ClassNotFoundException;

class priceModifierFactory implements priceModifierFactoryInterface
{

    public function create(string $modifyType): PriceModifierInterface
    {

        $modifyBaseClassName = str_replace('_','',ucwords($modifyType,'_')) ;
        $modifier =  self::PRICE_MODIFIER_NAMESPACE.$modifyBaseClassName;


        if (!class_exists($modifier))
        {
            throw new ClassNotFoundException('the class not found the name',$modifier);
        }

        return new $modifier();
    }
}
