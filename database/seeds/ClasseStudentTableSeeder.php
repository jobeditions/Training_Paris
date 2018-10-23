<?php

use Illuminate\Database\Seeder;

class ClasseStudentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('classe_student')->delete();
        
        \DB::table('classe_student')->insert(array (
            0 => 
            array (
                'student_id' => 1,
                'classe_id' => 1,
            ),
            1 => 
            array (
                'student_id' => 2,
                'classe_id' => 1,
            ),
            2 => 
            array (
                'student_id' => 3,
                'classe_id' => 2,
            ),
            3 => 
            array (
                'student_id' => 4,
                'classe_id' => 2,
            ),
            4 => 
            array (
                'student_id' => 5,
                'classe_id' => 2,
            ),
            5 => 
            array (
                'student_id' => 11,
                'classe_id' => 1,
            ),
            6 => 
            array (
                'student_id' => 10,
                'classe_id' => 1,
            ),
            7 => 
            array (
                'student_id' => 9,
                'classe_id' => 1,
            ),
            8 => 
            array (
                'student_id' => 8,
                'classe_id' => 1,
            ),
            9 => 
            array (
                'student_id' => 7,
                'classe_id' => 1,
            ),
            10 => 
            array (
                'student_id' => 6,
                'classe_id' => 1,
            ),
        ));
        
        
    }
}