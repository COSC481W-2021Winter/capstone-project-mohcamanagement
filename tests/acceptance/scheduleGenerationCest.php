<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\scheduleGenerationCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */
  
class scheduleGenerationCest
{
    //Tests to check that features are displayed correctly
    public function UserInterfaceTests(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/scheduleGeneration.php');
        //Test that checks if employees requests off table is displayed.
        $I->see('Time Request Off');
        $I->see('Start Date');
        $I->see('End Date');
        $I->see('Mandatory');
        $I->see('JDoe' , \Codeception\Util\Locator::elementAt('table#requestOff>tr', -2));
        $I->see('2021-04-05' , \Codeception\Util\Locator::elementAt('table#requestOff>tr', -2));
        //Test that checks if employees' availability table is displayed
        $I->see('Availability');
        $I->see('Employee');
        $I->see('JBond' , \Codeception\Util\Locator::elementAt('table#avail>tr', -1));
        $I->see('Off' , \Codeception\Util\Locator::elementAt('table#avail>tr', -1));
    }

    
    public function ManageShifts(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/scheduleGeneration.php');
        //Test to see if the shifts get added to drop down in edit schedule after adding new shifts in custom shifts
        $I->see('Add Custom Shifts');
        $I->fillField('shiftName', '5th');
        $I->selectOption('startTime','8:00');
        $I->selectOption('endTime','5:00');
        $I->click('Submit');
        $I->see('Edit Next Weeks Schedule');
        $I->selectOption('Monday','5th');
        //Test to see if the database gets updated when the manager updates the employee hours
        $I->click('EditSchedule');
        $I->seeInDatabase('workingschedule', ['Username' => 'JBond', 'Monday' => '5th']);
       
    }

    //Test to see that when creating a new user and adding availabilities, the availability table updates with a new row for that user
    public function CreateUserTableUpdate(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/adminCreateUser.php');
        $I->fillField('Username', 'Testing');
        $I->fillField('Pin', '1111');
        $I->checkOption('#shift3');
        $I->fillField('YearsWorked', '5');
        $I->Click('Create');
        $I->Click('Submit');
        $I->Click('Schedule Generation');
        $I->see('Testing' , \Codeception\Util\Locator::elementAt('table#avail>tr', -4));



       
    }

   
}


?>