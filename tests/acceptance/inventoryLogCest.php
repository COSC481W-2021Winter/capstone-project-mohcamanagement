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
}

?>