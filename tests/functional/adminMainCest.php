<?php
//adminMain testing framework
class userMainCest
{
	public function adminMain(FunctionalTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminMain.php');
    }
}
?>
