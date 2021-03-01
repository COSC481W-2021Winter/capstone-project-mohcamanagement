<?php

class inventoryOrderCest
{
	public function inventoryOrderAcceptanceTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryOrder.php');
		$I->see('Inventory Log');
	}

	public function backButtonTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryOrder.php');
		$I->setCookie('Username', 'John');
		$I->click('Back');
		$I->grabCookie('Username');
        $name = $I->seeCookie('Username');
		$I->see('Welcome '.$name);
	}

	public function amountVerificationTest(AcceptanceTester $I)
	{

	}

	public function dataReceivedVerificationTest(AcceptanceTester $I)
	{

	}

	public function verifyTableExistsTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryOrder.php');
		$I->seeElement('#orderTable');
	}
}

?>