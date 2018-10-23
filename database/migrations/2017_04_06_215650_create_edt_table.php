<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateEdtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */

    /*
    public function up()
    {
        Schema::create('edt', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('classe_id')->unsigned();
            $table->string('name');
            // $table->text('content');
            // $table->timestamp('due_date');
            // $table->boolean('optional')->default(false);
            // $table->boolean('allow_uploading')->default(false);
            // $table->timestamp('created_at')->useCurrent();
            // $table->integer('allow_delaying')->unsigned()->default(0);
            // $table->integer('max_files')->unsigned()->default(1);
            // $table->string('lesson_name');
            // $table->string('students_group_id');

        });
    }


     * Reverse the migrations.
     *
     * @return void

    public function down()
    {
        Schema::dropIfExists('edt');
    }
    */
}
