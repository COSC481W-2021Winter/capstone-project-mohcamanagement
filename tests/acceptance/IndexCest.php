<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\IndexCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */


  //check to see if simple buttons work
  
class ClickButtonsCest
{
    public function RegisterButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.html');
        $I->see('Mocha');

        $I->see('Register');
        $I->click('Register');
        $I->see('Back');
        $I->click('Back');

       $I->see('Mocha');

    }

    public function AboutButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.html');
        $I->see('Mocha');

        $I->see('About');
        $I->click('About');
        $I->see('Adham Oudeif');
        $I->click('Go Back');

       $I->see('Mocha');

    }
}

//Check to see if we can navigate through pages and use them

class SignInCest
{
    public function LoginButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.html');

        $I->see('Login');
        $I->click('Login');
        $I->fillField('Username', 'DKilroy');
        $I->fillField('Pin', '1117');
        $I->see('Submit');
        $I->click('Submit');
        $I->see('Welcome DKilroy');

    }
}

?>
