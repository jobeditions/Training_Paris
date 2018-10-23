<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notes_students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('note', 10, 0)->default(-1);
			$table->integer('note_ref')->unsigned()->nullable()->index('notes_students_note_ref_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('notes_students_student_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('notes_students');
	}

}
