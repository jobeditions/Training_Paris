<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 29/09/2016
 * Time: 21:21
 */
use Illuminate\Database\Seeder;

class ClassesStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classe_student')->insert([
            'student_id' => 1,
            'classe_id' => \App\Classe::where('name', 'TES1')->first()->id,
        ]);

        DB::table('classe_student')->insert([
            'student_id' => 2,
            'classe_id' => \App\Classe::where('name', 'TES1')->first()->id,
        ]);

        DB::table('classe_student')->insert([
            'student_id' => 3,
            'classe_id' => \App\Classe::where('name', 'TS1')->first()->id,
        ]);

        DB::table('classe_student')->insert([
            'student_id' => 4,
            'classe_id' => \App\Classe::where('name', 'TS1')->first()->id,
        ]);

        DB::table('classe_student')->insert([
            'student_id' => 5,
            'classe_id' => \App\Classe::where('name', 'TS1')->first()->id,
        ]);
    }
}
