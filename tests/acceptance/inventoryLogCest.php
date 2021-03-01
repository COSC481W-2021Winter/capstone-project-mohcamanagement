<?php

class inventoryLogCest
{
	public function inventoryLogAcceptanceTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->see('Inventory Log');
	}

	public function verifyTableExistsTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->seeElement('#itemTable');
	}

	public function verifyItemAddedTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->fillField('itemEntry', 'Pizza');
		$I->fillField('expectedPar', '3');
		$I->click('submit');
		$I->amOnPage('/pages/inventoryLog.php');
		$I->see('Pizza');
	}

	public function verifyItemDatabaseTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->fillField('itemEntry', 'Pizza');
		$I->fillField('expectedPar', '3');
		$I->click('submit');
		$I->amOnPage('/pages/inventoryLog.php');
		$I->seeInDatabase('inventory', ['item' => 'Pizza', 'Par' => '3']);
	}

	//Logic needs to be implemented
	public function verifyRemovalDatabaseTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->click('remove');
		$I->amOnPage('/pages/inventoryLog.php');
		$I->dontSeeInDatabase('inventory', ['item' => 'Pizza', 'Par' => '3']);
	}
}

?>