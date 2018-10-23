<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEdtPeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('edt_periods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('start')->nullable();
			$table->time('end')->nullable();
			$table->string('label')->nullable();
			$table->boolean('class_id')->default(0);
			$table->integer('school_id')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('edt_periods');
	}

}
