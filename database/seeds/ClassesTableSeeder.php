<?php
/**
 * Copyright (c) Liigem 2016.
 */
/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 31/08/2016
 * Time: 09:33
 */
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'name' => 'TES1',
            'school_id' => 2
        ]);
        DB::table('classes')->insert([
            'name' => 'TS1',
            'school_id' => 2
        ]);

    }
}
