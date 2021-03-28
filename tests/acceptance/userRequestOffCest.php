<?php
class scheduleCest {
public function scheduleWorks(AcceptanceTester $I)
    {
        $I->amOnPage('pages/userRequestOff.php');
        $I->see('Request Off');
        $I->see('Start Date');

        $I->see('End Date');
        $I->see('Mandatory');
        $I->see('Optional');
        $I->see('Back');
        $I->click('Back');
        $I->amOnPage('pages/userMain.php');
        // $I->see('Submit');
        $I->grabCookie('Username');
        $I->setCookie('Username','Brandon');
        $I->seeCookie('Username');
        

        //   $I->click('Submit');
        //   $I->amOnPage('pages/userMain.php');
    }


    // Test that checks if error box pops up if the user enters a date that is not a week in advance.
    public function invalidDate(AcceptanceTester $I)
    {
        // Login first as an employee
        $I->amOnPage('index.html');
        $I->click('Login');
        $I->fillField('Username', 'JBond');
        $I->fillField('Pin', '5555');
        $I->click('Submit');
        $I->see('Welcome JBond');

        // Go to Request off page
        $I->click('Request Off');
        
        // Submit form 
        // Dates are prefilled with current date by default so you don't need to fill field
        $I->click('Submit');
        $I->seeElement('#invalidDate');

    }


    // Test that checks if error box pops up if the user enters an end date that is before the start date.
    public function invalidDate1(AcceptanceTester $I)
    {
        // Login first as an employee
        $I->amOnPage('index.html');
        $I->click('Login');
        $I->fillField('Username', 'JBond');
        $I->fillField('Pin', '5555');
        $I->click('Submit');
        $I->see('Welcome JBond');

        // Go to Request off page
        $I->click('Request Off');
        
        // Valid start date, but end date is before start date
        $I->fillField('from', '05/01/2021');
        $I->fillField('until', '04/01/2021');

        // Submit form
        $I->click('Submit');
        $I->seeElement('#invalidDate1');

    }
    
    public function validDate(AcceptanceTester $I)
    {
        // Login first as an employee
        $I->amOnPage('index.html');
        $I->click('Login');
        $I->fillField('Username', 'JBond');
        $I->fillField('Pin', '5555');
        $I->click('Submit');
        $I->see('Welcome JBond');

        // Go to Request off page
        $I->click('Request Off');

        // Fill in dates here

 		$I->fillField('from', '06/01/2021');
        $I->fillField('until', '06/20/2021');

        // Submit form
        $I->click('Submit');
        $I->seeElement('#validDate');
        
    }
    
}
    ?>