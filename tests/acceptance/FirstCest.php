<?php
//first test, local server. it checks to see if the front page works
class FirstCest
{
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/index.html');
        $I->see('Mocha');
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
