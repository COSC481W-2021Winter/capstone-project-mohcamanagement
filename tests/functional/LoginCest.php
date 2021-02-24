<?php
// Test Command: vendor\bin\codecept.bat run tests\functional\LoginCest.php



class LoginCest
{
	// checks to see if the login button works and navigates to the main page
    public function loginTest(FunctionalTester $I)
    {
        $I->amOnPage('/pages/login.php');
        $I->fillField('Username', 'JDoe');
        $I->fillField('Pin', '1234');
        $I->click('Submit');
        $I->see('Welcome JDoe');
    }

    // checks to see if the alert message shows up when the info isnt entered properly
	public function loginTestFail(FunctionalTester $I)
    {
        $I->amOnPage('/pages/login.php');
        $I->fillField('Username', '');
        $I->fillField('Pin', '');
        $I->click('Submit');
        $I->seeElement('#failCredCheck');

    }    

    // checks to see if the back button works and navigates back to index page
    public function backButtonTest(FunctionalTester $I) {

        $I->amOnPage('/pages/login.php');
    	$I->click('Back');
    	$I->see('Mocha Managment');
    }
}

?>