<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('school_teacher', function(Blueprint $table)
		{
			$table->integer('school_id')->unsigned()->nullable()->index('school_teacher_school_id_foreign');
			$table->integer('teacher_id')->unsigned()->nullable()->index('school_teacher_teacher_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('school_teacher');
	}

}
