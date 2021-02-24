<?php
// Test Command: vendor\bin\codecept.bat run tests\acceptance\userMainACest.php

class userMainACest{
	//Checks to make sure you're on the user main page
    public function userMainAcceptanceTest(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/userMain.php');
        $I->see('Welcome');
    }
}
?>