<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClasseStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classe_student', function(Blueprint $table)
		{
			$table->integer('student_id')->unsigned()->nullable()->index('classe_student_student_id_foreign');
			$table->integer('classe_id')->unsigned()->nullable()->index('classe_student_classe_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('classe_student');
	}

}
