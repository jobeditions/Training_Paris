<?php

use Illuminate\Database\Seeder;

class ClassePeriodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('classe_periods')->delete();
        
        \DB::table('classe_periods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Premier semestre',
                'start_date' => '2016-09-01 23:00:00',
                'end_date' => '2017-03-01 23:00:00',
                'class_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Deuxième semestre',
                'start_date' => '2017-03-01 23:00:01',
                'end_date' => '2017-06-30 19:09:44',
                'class_id' => 1,
            ),
        ));
        
        
    }
}