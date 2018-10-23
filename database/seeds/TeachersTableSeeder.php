<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 29/09/2016
 * Time: 21:20
 */
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'user_id' => \App\User::where('name','Nathanaël')->first()->id
        ]);
        DB::table('teachers')->insert([
            'user_id' => \App\User::where('name','Professeur')->first()->id
        ]);
    }
}
