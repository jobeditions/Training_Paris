<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdtCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edt_cours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->integer('classe');
            $table->integer('group');
            $table->integer('matiere');
            $table->integer('teacher');
            $table->integer('room_id');
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
        Schema::dropIfExists('edt_cours');
    }
}
