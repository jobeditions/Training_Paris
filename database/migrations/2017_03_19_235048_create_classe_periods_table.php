<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassePeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classe_periods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->integer('class_id')->unsigned()->nullable()->index('classe_periods_class_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('classe_periods');
	}

}
