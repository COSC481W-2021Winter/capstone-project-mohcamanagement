<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\IndexCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */

class SigninCest
{
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('index.html');

        $I->click('Login');
        $I->see('Login');
    }
}

class FirstCest
{
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.html');
        $I->see('Mocha');
    }

}

?>
