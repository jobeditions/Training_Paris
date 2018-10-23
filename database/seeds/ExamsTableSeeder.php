<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 08/11/2016
 * Time: 18:41
 */
use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            'teacher_id' => \App\Teacher::where('user_id',3)->first()->id,
            'classe_id' => \App\Classe::where('name','TES1')->first()->id,
            'name'=>'Interro de maths',
            'content'=>'Trigo, équa diff, séries de Fourrier et tequila',
            'due_date'=>new DateTime('2016-12-25T23:00:00.012345Z'),
            'created_at'=>new DateTime('2016-11-10T23:00:00.012345Z'),
            'surprise'=>false
        ]);
        DB::table('exams')->insert([
            'teacher_id' => \App\Teacher::where('user_id',2)->first()->id,
            'classe_id' => \App\Classe::where('name','TES1')->first()->id,
            'name'=>'Interro surprise !',
            'content'=>'Bwa ah ah :3',
            'due_date'=>new DateTime('2016-12-30T23:00:00.012345Z'),
            'created_at'=>new DateTime('2016-11-10T23:00:00.012345Z'),
            'surprise'=>true
        ]);
    }
}
