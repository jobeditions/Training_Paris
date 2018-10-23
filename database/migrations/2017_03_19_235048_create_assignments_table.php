<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('teacher_id')->unsigned()->index('assignments_teacher_id_foreign');
			$table->integer('classe_id')->unsigned()->index('assignments_classe_id_foreign');
			$table->string('name');
			$table->text('content', 65535);
			$table->dateTime('due_date');
			$table->boolean('optional')->default(0);
			$table->integer('max_files')->unsigned()->default(0);
			$table->integer('allow_delaying')->unsigned()->default(0);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('assignments');
	}

}
