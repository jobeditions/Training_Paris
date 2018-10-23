<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassesMatieresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classes_matieres', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('classe_id');
			$table->integer('matiere_id');
			$table->integer('coefficient')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('classes_matieres');
	}

}
