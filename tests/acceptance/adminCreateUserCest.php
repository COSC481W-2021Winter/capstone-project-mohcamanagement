<?php
// To run on mac: $codecept run tests/acceptance/adminCreateUserCest.php --steps
// To run on Windows: vendor\bin\codecept.bat run tests\acceptance\adminCreateUserCest.php
// Directory: C:\xampp\htdocs\capstone-project-mohcamanagement

class adminCreateUserCest
{
    // Tests to see when all the info is entered in and hitting the submit button takes you to adminCreation page
    public function CreateUserTest(AcceptanceTester $I)
    {
        $I->amOnUrl('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');
        $I->see('Create User');
        $I->fillField('Username', 'WillSmith');
        $I->fillField('Pin', '1999');
        $I->seeElement('//*[@id="shift1"]');
        $I->dontSeeCheckboxIsChecked('#shift1');
        $I->checkOption('#shift1');
        $I->seeCheckboxIsChecked('#shift1');
        $I->seeElement('//*[@id="shift2"]');
        $I->dontSeeCheckboxIsChecked('#shift2');
        $I->checkOption('#shift2');
        $I->seeCheckboxIsChecked('#shift2');
        $I->seeElement('//*[@id="shift3"]');
        $I->dontSeeCheckboxIsChecked('#shift3');
        $I->checkOption('#shift4');
        $I->seeCheckboxIsChecked('#shift4');
        $I->fillField('YearsWorked', '5');
        $I->click('Submit');
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminMain.php');
        
    }

     // Tests to see when all the info is entered in and hitting the submit button takes you to adminCreation page
     public function EditUserTest(AcceptanceTester $I)
     {
         $I->amOnUrl('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');
         $I->see('Edit Employee');
         $option = $I->grabTextFrom('select option:nth-child(5)');
		 $I->selectOption("username", $option);
        //  $I->selectOption('form select[name=isManager]', '1');
        //  $I->checkOption("/descendant::input[@type='radio'][1]");
        //  $I->fillField('//*[@id="yearsWorked"]', '5');
         
     }

    // Tests to see if an alert box pops up when no information is entered.
    public function CreateUserTestFail(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');
        $I->see('Create User');
        $I->fillField('Username', '');
        $I->fillField('Pin', '');
        $I->click('Submit');
        $I->expect('Error Username and Pin must be entered.'); 
    }
    
    // Tests to see if an alert box pops up when duplicate information from the database is entered.
    public function TestDuplicateInfoFail(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreateUser.php');
        $I->see('Create User');
        $I->fillField('Username', 'DKilroy');
        $I->fillField('Pin', '1117');
        $I->click('Submit');
        $I->expect('Error Username and Pin already in database.'); 
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