<?php
/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 4/6/2017
 * Time: 11:40 AM
 */

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__ . '/../bootstrap/app.php';
		$app->make(Kernel::class)->bootstrap();
		return $app;
	}
}