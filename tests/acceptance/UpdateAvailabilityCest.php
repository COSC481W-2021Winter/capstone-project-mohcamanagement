<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\UpdateAvailabilityCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */


  //check to see if simple buttons work
  
class AdminNavButtonsCest
{
    public function NavButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('userUpdateAvailabilty.php');
        $I->fillField('Username', 'DKilroy');
        $I->fillField('Pin', '1117');
    }
}
?>