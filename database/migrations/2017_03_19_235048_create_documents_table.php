<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('teacher_id')->unsigned()->nullable()->index('documents_teacher_id_foreign');
			$table->string('path');
			$table->string('type');
			$table->integer('class_id')->unsigned()->nullable()->index('documents_class_id_foreign');
			$table->integer('assignment_id')->unsigned()->nullable()->index('documents_assignment_id_foreign');
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
		Schema::dropIfExists('documents');
	}

}
