<?php
// Test Command: vendor\bin\codecept.bat run tests\acceptance\adminMainACest.php

class userMainACest{
	//Checks to make sure you're on the admin main page
    public function adminMainAcceptanceTest(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/adminMain.php');
        $I->see('Welcome');
    }
}
?>