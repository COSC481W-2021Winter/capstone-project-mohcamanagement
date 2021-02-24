<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\adminNavCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */


  //check to see if simple buttons work
  
class AdminNavButtonsCest
{
    public function NavButtonWorks(AcceptanceTester $I)
    {
        $this-> AdminLoginWorks($I);
        
        $I->see('Welcome DKilroy');
        $I->amOnPage('adminMain.php');

        $I->see('Inventory Log');
        $I->click('Inventory Log');
        $I->click('Back');

        $I->see('Schedule Generation');
        $I->click('Schedule Generation');
        $I->click('Back');

        $I->see('Create Users');
        $I->click('Create Users');
        $I->click('Back');

        $I->see('Log Out');
        $I->click('Log Out');

        $I->amOnPage('index.html');

    }

    public function AdminLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index.html');

        $I->see('Login');
        $I->click('Login');
        $I->fillField('Username', 'DKilroy');
        $I->fillField('Pin', '1117');
        $I->see('Submit');
        $I->click('Submit');

    }
   
}

// class UserNavButtonsCest
// {
//     public function NavButtonWorks(AcceptanceTester $I)
//     {
//         $this-> UserLoginWorks($I);
        
//         $I->see('Welcome JDoe');
//         $I->amOnPage('adminMain.php');

//         // $I->see('Update Availability');
//         // $I->click('Update Availability');
//         // $I->click('Back');

//         $I->see('Request Off');
//         $I->click('Request Off');
//         $I->click('Back');

//         $I->see('Log Out');
//         $I->click('Log Out');
     
//         $I->amOnPage('index.html');

//     }
    
//     public function UserLoginWorks(AcceptanceTester $I)
//     {
//         $I->amOnPage('index.html');

//         $I->see('Login');
//         $I->click('Login');
//         $I->fillField('Username', 'JDoe');
//         $I->fillField('Pin', '1234');
//         $I->see('Submit');
//         $I->click('Submit');

//     }
   
// }
?>