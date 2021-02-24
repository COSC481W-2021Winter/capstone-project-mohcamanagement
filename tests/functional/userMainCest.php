<?php
//Usermain testing framework
class userMainCest
{
    public function userMainWorks(FunctionalTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/userMain.php');
        $I->see('Welcome');
    }
}
?>
