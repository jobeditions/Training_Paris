<?php

namespace Tests\Browser;

use DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
	/**
	 * Check that we can see the registration page
	 *
	 * @return void
	 */
	public function test_see_registration_page()
	{
		$this->browse(function (Browser $browser)
		{
			$browser->visit('/register')
				->assertSee('Inscription');
		});
	}

	/**
	 * Check that we can actually register
	 *
	 * @return void
	 */
	public function test_registration()
	{
		$this->browse(function (Browser $browser)
		{
			$browser->visit('/register')
				->type('first_name', 'Maître Test')
				->type('last_name', 'Hibou II')
				->type('email', 'maitrehibou@liigem.io')
				->type('password', 'ceciestunpasswordtropC00l')
				->type('password_confirmation', 'ceciestunpasswordtropC00l')
				->type('#code', DB::table('invites')->where('status', 'pending')->first()->code)
				->check('#cgu')
				->press('S\'inscrire')
				->assertPathIs('/teacher/dashboard');
		});
	}


}
