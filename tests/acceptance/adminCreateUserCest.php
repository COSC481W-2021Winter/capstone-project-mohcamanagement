<?php
// To run on mac: $codecept run tests/acceptance/adminCreateUserCest.php --steps
// To run on Windows: >vendor\bin\codecept.bat run tests\acceptance\adminCreateUserCest.php

class adminCreateUserCest
{
    // Tests to see when all the info is entered in and hitting the submit button takes you to adminCreation page
    public function adminCreateUserTest(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');
        $I->see('Create User');
        $I->fillField('Username', 'JessyPoe');
        $I->fillField('Pin', '1192');
        $I->fillField('Monday', '9am-5pm');
        $I->fillField('Tuesday', '9am-5pm');
        $I->fillField('Wednesday', '9am-5pm');
        $I->fillField('Thursday', '9am-5pm');
        $I->fillField('Friday', '9am-5pm');
        $I->fillField('Saturday', '7am-3pm');
        $I->fillField('Sunday', '7am-3pm');
        $I->fillField('YearsWorked', '7');
        $I->click('Submit');
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminMain.php');
        
    }

    // Tests to see if an alert box pops up when no information is entered.
    public function adminCreateUserTestFail(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');
        $I->see('Create User');
        $I->fillField('Username', '');
        $I->fillField('Pin', '');
        $I->click('Submit');
        //$I->seeElement('#alert'); // Does not work yet, figuring it out.
    }
    

    // Tests to see if the back button takes user to main page
    public function adminCreateUserBackButton(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');        
        $I->click('Back');
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminMain.php');
    }

}


?>