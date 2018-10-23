<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClasseTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classe_teacher', function(Blueprint $table)
		{
			$table->integer('teacher_id')->unsigned()->nullable()->index('classe_teacher_teacher_id_foreign');
			$table->integer('classe_id')->unsigned()->nullable()->index('classe_teacher_classe_id_foreign');
			$table->string('subject')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('classe_teacher');
	}

}
