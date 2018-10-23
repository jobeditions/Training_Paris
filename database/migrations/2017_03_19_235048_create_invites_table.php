<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invites', function(Blueprint $table)
		{
			$table->string('email');
			$table->string('code');
			$table->integer('from_id')->unsigned()->nullable()->index('invites_from_id_foreign');
			$table->string('status')->default('pending');
			$table->integer('free_days')->default(90);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('invites');
	}

}
