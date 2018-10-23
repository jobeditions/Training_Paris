<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstablishmentFranceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('establishment_france', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('uai')->unique();
			$table->string('official_name')->default('');
			$table->string('nature_label')->default('');
			$table->string('main_name')->default('');
			$table->string('patronyme')->default('');
			$table->string('type')->default('public');
			$table->string('address');
			$table->string('address2')->default('');
			$table->integer('bp_uai')->default(0);
			$table->string('zipcode', 5);
			$table->string('city');
			$table->float('location_x', 10, 0);
			$table->float('location_y', 10, 0);
			$table->string('state')->default('open');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('establishment_france');
	}

}
