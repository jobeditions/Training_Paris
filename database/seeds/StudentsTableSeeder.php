<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('students')->delete();
        
        \DB::table('students')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'school_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'school_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'school_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 8,
                'school_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 7,
                'school_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 9,
                'school_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 10,
                'school_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 11,
                'school_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'user_id' => 12,
                'school_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'user_id' => 13,
                'school_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'user_id' => 14,
                'school_id' => 1,
            ),
        ));
        
        
    }
}