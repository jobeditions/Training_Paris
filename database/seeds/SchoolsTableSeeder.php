<?php
/**
 * Copyright (c) Liigem 2016.
 */
/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 18/12/2016
 * Time: 18:06
 */
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'name' => 'Saint Jean Hulst',
            'city_name' => 'Versailles',
            'headmaster_id' => \App\User::where('name','Nathanael')->first()->id,
            'headmaster_pays' => true
        ]);
        DB::table('schools')->insert([
            'name' => 'Lycée International',
            'city_name' => 'Saint-Germain en Laye',
            'headmaster_id' => \App\User::where('name','Nathanael')->first()->id,
            'headmaster_pays' => false
        ]);

    }
}
