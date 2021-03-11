<?php

/*Test Command: vendor\bin\codecept.bat run tests\acceptance\UpdateAvailabilityCest.php
  Directory: C:\xampp\htdocs\capstone-project-mohcamanagement
  */


  //check to see if simple buttons work
  
class UpDateScheduleCest
{

    public function Input_ButtonWorks(AcceptanceTester $I)
    {
      //Login
       $I->amOnPage('index.html');
        $I->see('Login');
        $I->click('Login');
        $I->fillField('Username', 'JBond');
        $I->fillField('Pin', '5555');
        $I->see('Submit');
        $I->click('Submit');
        $I->see('Welcome JBond');
      //Tests
      //$I->amOnPage('/pages/userUpdateAvailabilty.php');
      $I->click('Update Availability');
      $I->see('Shift Information');
      //Check that shift times are displayed on the table
      $I->see('1st');
      $I->see('6:30');
      $I->see('1:30');
      // Test to see if user availability is updated and that check boxes and drop down work
      $I->see('Day Selection');
      $option = $I->grabTextFrom('select option:nth-child(5)');
      $I->selectOption("DaySelection", $option);
      $I->seeElement('#shift1');
      $I->dontSeeCheckboxIsChecked('#shift1');
      $I->checkOption('#shift1');
      $I->seeCheckboxIsChecked('#shift1');
      $I->click('Add');
      $I->see('Friday');
      //see if taking a day off the table works
      $option = $I->grabTextFrom('select option:nth-child(5)');
      $I->selectOption("DaySelection", $option);
      $I->seeElement('#shift4');
      $I->dontSeeCheckboxIsChecked('#shift4');
      $I->checkOption('#shift4');
      $I->seeCheckboxIsChecked('#shift4');
      $I->click('Add');
      $I->see('Off');
       //test to see if when you click a shift and "off" simultaneously, it updates that day as "off"
       $option = $I->grabTextFrom('select option:nth-child(2)');
       $I->selectOption("DaySelection", $option);
       $I->checkOption('#shift1');
       $I->checkOption('#shift4');
       $I->click('Add');
       $I->see('off');
       
      //Test to see if error message shows up if you don't select a shift
      $option = $I->grabTextFrom('select option:nth-child(5)');
      $I->selectOption("DaySelection", $option);
      $I->click('Add');
      $I->seeElement('#failCheck');
      //Test to see if error message shows up if you don't select a day
      $I->seeElement('#shift4');
      $I->dontSeeCheckboxIsChecked('#shift4');
      $I->checkOption('#shift4');
      $I->seeCheckboxIsChecked('#shift4');
      $I->click('Add');
      $I->seeElement('#failCheck');
    



      



    
    }
}
?>