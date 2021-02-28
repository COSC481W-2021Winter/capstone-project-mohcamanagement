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
}
    ?>