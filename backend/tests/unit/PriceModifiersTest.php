<?php

namespace App\Tests\unit;

use App\DTO\LowestPriceEnquiry;
use App\Entity\Promotion;
use App\Filter\Modifier\DateRangeMultiplier;
use App\Filter\Modifier\EvenItemsMultiplier;
use App\Filter\Modifier\FixedPriceVoucher;
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

    /** @test */
    public function testFixedPriceVoucher_returns_a_correctly_modified_price(): void
    {
        $fixedPriceVoucher = new FixedPriceVoucher();

        $promotion = new Promotion();
        $promotion->setName('Voucher OU812');
        $promotion->setAdjustment(100);
        $promotion->setCriteria(["code" => "OU812"]);

        $promotion->setType('fixed_price_voucher');

        $enquiry = new LowestPriceEnquiry();

        $enquiry->setQuantity(5);
        $enquiry->setVoucherCode('OU812');


        $modifiedPrice = $fixedPriceVoucher->modify(150, 5, $promotion, $enquiry);
        $this->assertEquals(500, $modifiedPrice);
    }

    /** @test */
    public function testEvenItemsMultiplier_returns_a_correctly_modified_price(): void
    {
        // Given
        $enquiry = new LowestPriceEnquiry();
        $enquiry->setQuantity(5);

        $promotion = new Promotion();
        $promotion->setName('Buy one get one free');
        $promotion->setAdjustment(0.5);
        $promotion->setCriteria(["minimum_quantity" => 2]);
        $promotion->setType('even_items_multiplier');

        $evenItemsMultiplier = new EvenItemsMultiplier();

        // When
        $modifiedPrice = $evenItemsMultiplier->modify(100, 5, $promotion, $enquiry);

        // Then
        // ((100 * 4) * 0.5) + (1 * 100)
       // $this->assertEquals(300, $modifiedPrice);
         $this->assertEquals(301, $modifiedPrice);
    }

    /** @test */
    /*public function testEvenItemsMultiplier_correctly_alternatives(): void
    {
        // Given
        $enquiry = new LowestPriceEnquiry();
        $enquiry->setQuantity(5);

        $promotion = new Promotion();
        $promotion->setName('Buy one get one free');
        $promotion->setAdjustment(0.75);
        $promotion->setCriteria(["minimum_quantity" => 2]);
        $promotion->setType('even_items_multiplier');

        $evenItemsMultiplier = new EvenItemsMultiplier();

        // When
        $modifiedPrice = $evenItemsMultiplier->modify(100, 5, $promotion, $enquiry);

        // Then
        // ((100 * 4) * 0.5) + (1 * 100)
        // $this->assertEquals(300, $modifiedPrice);
        $this->assertEquals(301, $modifiedPrice);
    }*/

}
