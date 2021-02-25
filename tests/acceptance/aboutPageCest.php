<?php

class aboutPageCest
{
    public function aboutPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('pages/about.html');
  		$I->see('Mocha Management');
        $I->see('The Developers');
  		$I->see('Douha Alemara');
    
    }
    
    
    
    
     public function GoBackButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('pages/about.html');
        $I->see('Mocha Management');
        $I->see('Go Back');
        $I->click('Go Back');
        $I->see('Register');
        $I->click('About');

       $I->see('The Developers');

    }

    
    
}



//test result:
/*
C:\xampp\htdocs\capstone-project-mohcamanagement>vendor\bin\codecept.bat run tests\acceptance\FirstCest.php
Codeception PHP Testing Framework v4.1.17
Powered by PHPUnit 9.5.2 by Sebastian Bergmann and contributors.

Acceptance Tests (1) ---------------------------------------------------------------------------------------------------
+ FirstCest: Frontpage works (0.04s)
------------------------------------------------------------------------------------------------------------------------


Time: 00:00.086, Memory: 10.00 MB

OK (1 test, 1 assertion)
*/

?>



