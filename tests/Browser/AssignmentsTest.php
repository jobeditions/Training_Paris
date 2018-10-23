<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AssignmentsTest extends DuskTestCase
{
	/**
	 * Check that we can see the registration page
	 *
	 * @return void
	 */
	public function test_see_assignments_page()
	{
		$this->browse(function (Browser $browser)
		{
			$browser->loginAs(\App\User::find(2))
				->visit('/teacher/assignments')
				->assertSee('LISTE DES DEVOIRS REMIS À VOS ÉLÈVES');
		});
	}

	/**
	 * Check that we can actually register
	 *
	 * @return void
	 */
	public function test_adding_assignment()
	{
		$this->browse(function (Browser $browser)
		{
			$browser->loginAs(\App\User::find(2))
				->visit('/teacher/assignments/create')
				->type('name', 'Commentaire de texte')
				->type('content', 'Commentez les deux premiers paragraphe du chapitre 17 du livre X des Confessions de Saint Augustin')
				->click('.today')
				->press('Valider')
				->assertPathIs('/teacher/assignments');
		});
	}


}
