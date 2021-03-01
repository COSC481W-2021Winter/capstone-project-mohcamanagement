<?php

class inventoryOrderCest
{
	public function inventoryOrderAcceptanceTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryOrder.php');
		$I->see('Inventory Log');
	}

	public function backButtonUserTest(AcceptanceTester $I)
	{

	}


	public function backButtonAdminTest(AcceptanceTester $I)
	{

	}

	public function amountVerificationTest(AcceptanceTester $I)
	{

	}

	public function dataReceivedVerificationTest(AcceptanceTester $I)
	{

	}

	public function verifyTableEntriesTest(AcceptanceTester $I)
	{

	}
}

?>