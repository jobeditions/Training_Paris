<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notes')->delete();
        
        \DB::table('notes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Interrogation',
                'coefficient' => 1,
                'bareme' => 20,
                'type' => 'other',
                'average' => 0,
                'mediane' => 0,
                'class_id' => 1,
                'matiere' => 4,
                'add_date' => '2017-03-13 00:00:00',
                'publish_date' => '2017-03-13 00:00:00',
                'period' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'POI',
                'coefficient' => 3,
                'bareme' => 15,
                'type' => 'other',
                'average' => 13,
                'mediane' => 11,
                'class_id' => 1,
                'matiere' => 4,
                'add_date' => '2017-03-13 00:00:00',
                'publish_date' => '2017-03-13 00:00:00',
                'period' => 2,
            ),
        ));
        
        
    }
}