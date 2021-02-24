<?php
// To run on mac: $codecept run tests/acceptance/companyRegisterCest.php --steps
// To run on Windows: >vendor\bin\codecept.bat run tests\acceptance\companyRegisterCest.php

class companyRegisterCest
{
    // Tests to see when all the info is entered in and hitting the submit button takes you to adminCreation page
    public function companyRegisterTest(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/companyRegister.php');
        $I->see('Company Register');
        $I->fillField('companyName', 'Mocha Management');
        $I->selectOption('companyType', 'LLC');
        $I->fillField('email', 'mochamanagement@gmail.com');
        $I->fillField('irsNum', '123456789');
        $I->fillField('phoneNo', '7341234567');
        $I->fillField('address', '1234 Some St.');
        $I->fillField('city', 'Yipsilanti');
        $I->selectOption('state', 'Michigan');
        $I->fillField('zipCode', '12345');
        $I->click('Submit');
        $I->amOnPage('http://localhost:8080/capstone-project-mohcamanagement/src/pages/adminCreation.php');
        
    }
}


?>