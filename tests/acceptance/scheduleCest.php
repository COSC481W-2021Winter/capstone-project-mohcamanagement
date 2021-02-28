<?php
class scheduleCest {
    public function scheduleWorks(AcceptanceTester $I)
    {
        $I->amOnPage('pages/scheduleGeneration.php');
        $I->see('Work Schedule');
        $I->see('Employee');
        $I->see('Monday');
        $I->see('Tuesday');
        $I->see('Wednesday');
        $I->see('Thursday');
        $I->see('Friday');
        $I->see('Saturday');
        $I->see('Sunday');
        // $I->grabCookie('Username');
        // $userName=$I->setCookie('Username','Brandon');
        // $I->seeCookie('Username');
        // $user= $I->grabTextFrom('#user');
        // echo ($userName==$user);


        // $I->haveInDatabase('Users', [
        //     'Username' => 'DKill'
        //   ]);
        //   $I->see('DKill');

          $I->click('Back');
          $I->amOnPage('pages/adminMain.php');
    }
}
    ?>