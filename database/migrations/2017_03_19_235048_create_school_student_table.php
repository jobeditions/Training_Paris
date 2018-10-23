<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('school_student', function(Blueprint $table)
		{
			$table->integer('school_id')->unsigned()->nullable()->index('school_student_school_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('school_student_student_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('school_student');
	}

}
