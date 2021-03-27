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
        

        // Fill form where start date is not a week in advance
        $I->click('Submit');
        $I->seeElement('#invalidDate');

    }

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

        // Fill form where start date is not a week in advance
        $I->click('Submit');
        $I->seeElement('#invalidDate1');

    }
}
    ?>