<?php
/**
 * @package     redSHOP
 * @subpackage  Step Class
 * @copyright   Copyright (C) 2008 - 2019 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Configuration;
use AcceptanceTester\AdminManagerJoomla3Steps;
use ConfigurationPage;
use FrontEndProductManagerJoomla3Page;
use ProductManagerPage as ProductManagerPage;

/**
 * Class ProductsConfigurationSteps
 * @package Configuration
 * @since 2.1.2
 */
class ProductsConfigurationSteps extends AdminManagerJoomla3Steps
{
	/**
	 * @param $categoryName
	 * @param $productName
	 * @param $nameAttribute
	 * @throws \Exception
	 * @since 2.1.2
	 */
	public function checkProductWithAttributeStockRoomYes($categoryName, $productName, $nameAttribute)
	{
		$I = $this;
		$I->amOnPage(ProductManagerPage::$url);
		$I->waitForText($categoryName, 30);
		$I->click($categoryName);
		$I->waitForText($productName, 30);
		$I->click($productName);
		$I->waitForText($productName);
		$I->see($nameAttribute);
		$I->waitForText(ConfigurationPage::$messOutOfStockRoom,30);
		$I->see(ConfigurationPage::$messOutOfStockRoom);
	}

	/**
	 * @param $categoryName
	 * @param $productName
	 * @param $nameAttribute
	 * @throws \Exception
	 * @since 2.1.2
	 */
	public function checkProductWithAttributeStockRoomNo($categoryName, $productName, $nameAttribute)
	{
		$I = $this;
		$I->amOnPage(ProductManagerPage::$url);
		$I->waitForText($categoryName,30);
		$I->click($categoryName);
		$I->waitForText($productName,30);
		$I->click($productName);
		$I->dontSee($nameAttribute);
	}

	/**
	 * @throws \Exception
	 * @since 2.1.2
	 */
	public function configurationProductAccessory($function)
	{
		$I = $this;
		$I->amOnPage(ConfigurationPage::$URL);
		$I->waitForElementVisible(ConfigurationPage::$productTab, 30);
		$I->click(ConfigurationPage::$productTab);
		$I->waitForElementVisible(ConfigurationPage::$productAccessory, 30);
		$I->click(ConfigurationPage::$productAccessory);

		switch ($function) {
			case 'Yes':
				$I->waitForElementVisible(ConfigurationPage::$enableAccessoryYes, 30);
				$I->click(ConfigurationPage::$enableAccessoryYes);
				break;
			case 'No':
				$I->waitForElementVisible(ConfigurationPage::$enableAccessoryNo, 30);
				$I->click(ConfigurationPage::$enableAccessoryNo);
				break;
		}

		$I->click(ConfigurationPage::$buttonSaveClose);
		$I->assertSystemMessageContains(ConfigurationPage::$messageSaveSuccess);
	}

	/**
	 * @param $categoryName
	 * @param $productName
	 * @param $productNameRelated
	 * @param $function
	 * @throws \Exception
	 * @since 2.1.2
	 */
	public function checkConfigurationProductRelated($categoryName, $productName, $productNameRelated, $function)
	{
		$I = $this;
		$I->amOnPage(ProductManagerPage::$url);
		$I->waitForText($categoryName, 30);
		$I->click($categoryName);
		$I->waitForText($productNameRelated, 30);
		switch ($function)
		{
			case 'Yes':
				$I->click($productNameRelated);
				$I->waitForText($productName, 30);
				$I->see($productName);
				$I->click($productName);
				$I->waitForText($productNameRelated, 30);
				$I->see($productNameRelated);
				$I->see(FrontEndProductManagerJoomla3Page::$messageRelated);
				break;
			case 'No':
				$I->click($productNameRelated);
				$I->waitForText($productName, 30);
				$I->see($productName);
				$I->click($productName);
				$I->dontSee(FrontEndProductManagerJoomla3Page::$messageRelated);
				break;
		}

	}
}