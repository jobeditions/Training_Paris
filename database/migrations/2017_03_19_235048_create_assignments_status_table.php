<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentsStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignments_status', function(Blueprint $table)
		{
			$table->integer('student_id')->unsigned()->index('assignments_status_student_id_foreign');
			$table->integer('assignment_id')->unsigned()->index('assignments_status_assignment_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('assignments_status');
	}

}
