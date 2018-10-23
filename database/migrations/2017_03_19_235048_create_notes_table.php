<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->float('coefficient', 10, 0)->default(1);
			$table->float('bareme', 10, 0)->default(20);
			$table->string('type')->default('other');
			$table->float('average', 10, 0)->default(0);
			$table->float('mediane', 10, 0)->default(0);
			$table->integer('class_id')->unsigned()->nullable()->index('notes_class_id_foreign');
			$table->integer('matiere');
			$table->dateTime('add_date')->nullable();
			$table->dateTime('publish_date')->nullable();
			$table->integer('period')->nullable()->index('notes_period_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('notes');
	}

}
