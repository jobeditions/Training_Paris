<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
	/**
	 * A basic browser test example.
	 *
	 * @return void
	 */
	public function testHomePage()
	{
		$this->browse(function (Browser $browser)
		{
			$browser->visit('/')
				->assertSee('Avec un logiciel qui répond à vos besoins');
		});
	}
}
