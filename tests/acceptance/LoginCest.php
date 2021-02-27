<?php
// Test Command: vendor\bin\codecept.bat run tests\acceptance\LoginCest.php



class LoginCest {
	// checks to see if the login button works and navigates to the main page
    public function loginTest(AcceptanceTester $I) {
        $I->amOnPage('/pages/login.php');
        $I->fillField('Username', 'JDoe');
        $I->fillField('Pin', '1234');
        $I->click('Submit');
        $I->see('Welcome JDoe');
    }

    // checks to see if the alert message shows up when the info isnt entered properly
	public function loginTestFail(AcceptanceTester $I) {
        $I->amOnPage('/pages/login.php');
        $I->fillField('Username', '');
        $I->fillField('Pin', '');
        $I->click('Submit');
        $I->seeElement('#failCredCheck');
    }    

    // checks to see if the back button works and navigates back to index page
    public function backButtonTest(AcceptanceTester $I) {

        $I->amOnPage('/pages/login.php');
    	$I->click('Back');
    	$I->see('Mocha Managment');
    }

    public function checkCookies(AcceptanceTester $I) {
    	$I->amOnPage('/pages/userCheck.php');
		$I->setCookie('Username', 'Dill0');
        $I->grabCookie('Username');
        $I->seeCookie('Username');
    }
}

?>