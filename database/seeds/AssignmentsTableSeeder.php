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
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignments')->insert([
            'teacher_id' => \App\Teacher::where('user_id',3)->first()->id,
            'classe_id' => \App\Classe::where('name','TES1')->first()->id,
            'name'=>'DM de Maths',
            'content'=>'Ceci est votre premier DM de maths. Bonne chance !',
			'due_date' => Carbon::parse('next wednesday')->toDateTimeString(),
            'created_at'=>new DateTime('2016-11-10T23:00:00.012345Z'),
            'allow_delaying'=>1,
            'max_files'=>1,
            'optional'=>false
        ]);
        DB::table('assignments')->insert([
            'teacher_id' => \App\Teacher::where('user_id',3)->first()->id,
            'classe_id' => \App\Classe::where('name','TES1')->first()->id,
            'name'=>'Exercice numéro 2',
            'content'=>'Faites l\'exercice numéro de la feuille donnée en cours',
			'due_date' => Carbon::parse('next friday')->toDateTimeString(),
            'created_at'=>new DateTime('2016-12-10T23:00:00.012345Z'),
            'allow_delaying'=>0,
			'max_files' => 0,
            'optional'=>true
        ]);
        DB::table('assignments')->insert([
            'teacher_id' => \App\Teacher::where('user_id',2)->first()->id,
            'classe_id' => \App\Classe::where('name','TES1')->first()->id,
            'name'=>'Dissertation',
            'content'=>'Dissertez sur le sujet suivant : "Peut on imaginer un monde sans violence ?"',
			'due_date' => Carbon::parse('next thursday')->toDateTimeString(),
            'created_at'=>new DateTime('2016-12-10T23:00:00.012345Z'),
            'allow_delaying'=>0,
            'max_files'=>1,
            'optional'=>true
    ]);
    }
}
