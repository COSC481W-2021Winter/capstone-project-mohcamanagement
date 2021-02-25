<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\UpdateAvailabilityCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */


  //check to see if simple buttons work
  
class UpDateScheduleCest
{
    public function Input_ButtonWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/userUpdateAvailabilty.php');
        $I->see('Update');
        $I->fillField('monday', 'off');
        $I->fillField('tuesday', '7:11-9:11');
        $I->fillField('thursday', 'off');
        $I->fillField('friday', '11:00-11:00');
        $I->click('UPDATE SCHEDULE');
        $I->click('Cancel');
        $I->see('Welcome');
    }
}
?>