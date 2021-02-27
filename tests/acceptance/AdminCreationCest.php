<?php 

class AdminCreationCest {

	public function creationTest(AcceptanceTester $I) {
		$I->amOnPage('/pages/adminCreation.php');
		$I->fillField('Username', 'JBond');
		$I->fillField('Pin', '007');
		$I->click('Create');
        $I->see('Welcome JBond');
	}

	public function backButtonTest(AcceptanceTester $I) {
		$I->amOnPage('/pages/adminCreation.php');
		$I->click('Back');
		$I->see('Mocha Managment');
	}

	public function entriesNotEnteredTest(AcceptanceTester $I) {
		$I->amOnPage('/pages/adminCreation.php');
		$I->click('Create');
		$I->seeElement('#requireEntries');
	}
}

?>