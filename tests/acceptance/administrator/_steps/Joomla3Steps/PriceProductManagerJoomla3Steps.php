<?php
/**
 * Created by PhpStorm.
 * User: nhung nguyen
 * Date: 5/29/2017
 * Time: 2:03 PM
 */

namespace AcceptanceTester;


class PriceProductManagerJoomla3Steps extends AdminManagerJoomla3Steps
{


//    public function addDiscountPrice ($nameProduct,$price,$discountPrice)
    public function addDiscountPrice($productName, $priceDiscount)
    {
        $I = $this;
        $I->amOnPage(\PriceProductJoomla3Page::$URL);
        $I->searchProduct($productName);
        $I->wait(5);
        $I->fillField(\PriceProductJoomla3Page::$discount, $priceDiscount);
        $I->click(['xpath' => "//a[contains(@href,'savediscountprice')]"]);
    }


    public function addDiscountPriceMoreThan($productName, $priceDiscountThan)
    {
        $I = $this;
        $I->amOnPage(\PriceProductJoomla3Page::$URL);
        $I->searchProduct($productName);
        $I->wait(3);
        $I->fillField(\PriceProductJoomla3Page::$discount, $priceDiscountThan);
        $I->click(['xpath' => "//a[contains(@href,'savediscountprice')]"]);

    }

    public function addPriceLessDiscount($productName, $randomPriceLess)
    {
        $I = $this;
        $I->amOnPage(\PriceProductJoomla3Page::$URL);
        $I->searchProduct($productName);
        $I->wait(3);
        $I->fillField(\PriceProductJoomla3Page::$priceProduct, $randomPriceLess);
        $I->click(['xpath' => "//a[contains(@href,'saveprice')]"]);

    }
    public function searchProduct($productName)
    {
        $I = $this;
        $I->wantTo('Search the Product');
        $I->amOnPage(\PriceProductJoomla3Page::$URL);
        $I->waitForText('Product Management', 30, ['xpath' => "//h1"]);
        $I->filterListPriceProductSearch($productName);
    }


}