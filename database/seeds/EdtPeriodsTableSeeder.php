<?php

use Illuminate\Database\Seeder;

class EdtPeriodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('edt_periods')->delete();
        
        \DB::table('edt_periods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'start' => '08:15:00',
                'end' => '09:10:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'start' => '09:10:00',
                'end' => '10:05:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'start' => '10:05:00',
                'end' => '10:20:00',
                'label' => 'Récréation',
                'class_id' => 1,
                'school_id' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'start' => '10:20:00',
                'end' => '11:15:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'start' => '11:15:00',
                'end' => '12:10:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'start' => '12:10:00',
                'end' => '13:05:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'start' => '13:05:00',
                'end' => '14:00:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'start' => '14:00:00',
                'end' => '14:55:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'start' => '14:55:00',
                'end' => '15:50:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'start' => '15:50:00',
                'end' => '16:00:00',
                'label' => 'Récréation',
                'class_id' => 1,
                'school_id' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'start' => '16:00:00',
                'end' => '16:55:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'start' => '16:55:00',
                'end' => '17:50:00',
                'label' => NULL,
                'class_id' => 1,
                'school_id' => 0,
            ),
        ));
        
        
    }
}