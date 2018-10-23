<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppelEnClasseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appel_en_classe', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('class_id')->unsigned()->nullable()->index('appel_en_classe_class_id_foreign');
			$table->integer('user')->unsigned()->nullable()->index('appel_en_classe_user_foreign');
			$table->dateTime('date_validation');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('appel_en_classe');
	}

}
