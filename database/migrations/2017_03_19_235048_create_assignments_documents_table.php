<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentsDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignments_documents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('student_id')->unsigned()->nullable()->index('assignments_documents_student_id_foreign');
			$table->integer('assignment_id')->unsigned()->nullable()->index('assignments_documents_assignment_id_foreign');
			$table->string('path')->unique();
			$table->string('type');
			$table->timestamp('uploaded_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('meyenii', 700)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('assignments_documents');
	}

}
