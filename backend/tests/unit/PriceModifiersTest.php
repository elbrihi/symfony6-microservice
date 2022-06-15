<?php

namespace App\Tests\unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Promotion;
use App\Filter\Modifier\DateRangeMultiplier;
use App\Tests\ServiceTestCase;

class PriceModifiersTest extends ServiceTestCase
{
    public function testDateRangeMuliplier_returns_a_correctly_modified_price():void
    {
        $enquiry = new LowestPriceEnquiry();
        $enquiry->setQuantity(5);
        $enquiry->setRequestDate('2022-11-27');



        $promotion = new Promotion();
        $promotion->setName('Black Friday half price sale');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(["from" => "2022-11-25", "to" => "2022-11-28"]);
        $promotion->setType('date_range_multiplier');

         $dataRangerModifier =  new DateRangeMultiplier();
         $modifiedPrice = $dataRangerModifier->modify(100, 5, $promotion, $enquiry);

         $this->assertEquals(250,$modifiedPrice);

    }
}
