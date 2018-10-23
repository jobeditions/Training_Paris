<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAbsenceStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('absence_student', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('call_ref');
			$table->integer('student_id')->unsigned()->nullable()->index('absence_student_student_id_foreign');
			$table->string('type_absence')->default('unknown');
			$table->boolean('justified')->default(0);
			$table->text('justification_info', 65535)->nullable();
			$table->dateTime('absence_start')->nullable();
			$table->dateTime('absence_end')->nullable();
			$table->dateTime('last_edit')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('absence_student');
	}

}
