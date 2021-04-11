<?php
// Test Command: vendor\bin\codecept.bat run tests\acceptance\inventoryLogCest.php
// Directory: C:\xampp\htdocs\capstone-project-mohcamanagement

class inventoryLogCest
{
	public function inventoryLogAcceptanceTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->see('Inventory Type');
	}

	public function verifyTableExistsTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->seeElement('#itemTable');
	}

	public function verifyItemAddedTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->fillField('itemEntry', 'Tomato Caprese');
		$I->fillField('expectedPar', '3');
		$option = $I->grabTextFrom('select option:nth-child(4)');
		$I->selectOption("invType", $option);
		$I->click('addItem');
		$option = $I->grabTextFrom('select option:nth-child(4)');
		$I->selectOption("inventory", $option);
		
	}

	public function verifyOnHandDataBaseTest(AcceptanceTester $I)
	{
		// $I->amOnPage('index.html');
		// $I->click('Login');
		// $I->fillField(['name' => 'Username'], 'DKilroy');
        // $I->fillField(['name' => 'Pin'], '1117');
		$I->amOnPage('/pages/inventoryLog.php');
		$option = $I->grabTextFrom('select option:nth-child(2)');
		$I->selectOption("inventory", $option);

	}

}

?>