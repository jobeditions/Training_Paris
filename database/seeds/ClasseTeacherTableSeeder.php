<?php

use Illuminate\Database\Seeder;

class ClasseTeacherTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('classe_teacher')->delete();
        
        \DB::table('classe_teacher')->insert(array (
            0 => 
            array (
                'teacher_id' => 2,
                'classe_id' => 1,
                'subject' => 'Anglais',
            ),
            1 => 
            array (
                'teacher_id' => 1,
                'classe_id' => 2,
                'subject' => 'Anglais',
            ),
            2 => 
            array (
                'teacher_id' => 1,
                'classe_id' => 1,
                'subject' => 'Espagnol',
            ),
        ));
        
        
    }
}