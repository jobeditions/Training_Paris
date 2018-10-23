<?php

use Illuminate\Database\Seeder;

class SchoolStudentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('school_student')->delete();
        
        \DB::table('school_student')->insert(array (
            0 => 
            array (
                'school_id' => 2,
                'student_id' => 1,
            ),
            1 => 
            array (
                'school_id' => 2,
                'student_id' => 3,
            ),
        ));
        
        
    }
}