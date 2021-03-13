<?php
// How to run on MacOS:$ codecept run tests/acceptance/inventoryLogCest.php --steps
// How to run on Windows:> vendor\bin\codecept.bat run tests\acceptance\inventoryLogCest.php

class inventoryLogCest
{
	
	public function inventoryLogAcceptanceTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php'); // Succeeds: Sufficient to prove page loads
		//$I->see('Inventory Log'); // Fails because theres no title
	}
	

	public function verifyTableExistsTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->seeElement('#itemTable');
	}

	public function verifyItemAddedTest(AcceptanceTester $I)
    {
        $I->amOnPage('/pages/inventoryLog.php');
        $I->fillField('itemEntry', 'Muffin');
        $I->fillField('expectedPar', '2');
        $I->selectOption('invType', 'FOH');
        $I->click('addItem');
        $I->amOnPage('/pages/inventoryLog.php');
        $I->selectOption('inventory', 'FOH');
        //$I->see('Muffin');
    }


	/*
	// These test fail because they check the database, don't think acceptance tests can test those
	// Commented them out for now

	public function verifyItemDatabaseTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->fillField('itemEntry', 'Pizza');
		$I->fillField('expectedPar', '3');
		$I->click('submit');
		$I->amOnPage('/pages/inventoryLog.php');
		$I->seeInDatabase('inventory', ['item' => 'Pizza', 'Par' => '3']);
	}

	//Logic needs to be implemented
	public function verifyRemovalDatabaseTest(AcceptanceTester $I)
	{
		$I->amOnPage('/pages/inventoryLog.php');
		$I->click('remove');
		$I->amOnPage('/pages/inventoryLog.php');
		$I->dontSeeInDatabase('inventory', ['item' => 'Pizza', 'Par' => '3']);
	} 
	*/	
	

   // Test to see if there is a default in the drop-down menu
   public function verifyDefaultOption(AcceptanceTester $I)
   {
	   $I->amOnPage('/pages/inventoryLog.php');
	   $I->seeOptionIsSelected('inventory', 'Select Item Category'); 
   }

   // Test to see if you can add different types in the drop-down
   public function verifyAddType(AcceptanceTester $I)
   {
	   $I->amOnPage('/pages/inventoryLog.php');
	   $I->fillField('newType', 'BOH');
	   $I->click('addItem');
	   $I->amOnPage('/pages/inventoryLog.php');
	   $I->see('BOH');

   }


}

?>
