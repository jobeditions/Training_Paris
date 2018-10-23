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

class ClassesTeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classe_teacher')->insert([
            'teacher_id' => \App\Teacher::where('user_id',3)->first()->id,
            'classe_id' => \App\Classe::where('name', 'TES1')->first()->id,
            'subject' => "Anglais"
        ]);

        DB::table('classe_teacher')->insert([
            'teacher_id' => 1,
            'classe_id' => \App\Classe::where('name', 'TS1')->first()->id,
            'subject' => "Anglais"
        ]);

        DB::table('classe_teacher')->insert([
            'teacher_id' => 1,
            'classe_id' => \App\Classe::where('name', 'TES1')->first()->id,
            'subject' => "Espagnol"
        ]);
    }
}
