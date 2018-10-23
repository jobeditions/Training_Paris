<?php

use Illuminate\Database\Seeder;

class ClassesMatieresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('classes_matieres')->delete();
        
        \DB::table('classes_matieres')->insert(array (
            0 => 
            array (
                'id' => 1,
                'classe_id' => 1,
                'matiere_id' => 2,
                'coefficient' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'classe_id' => 1,
                'matiere_id' => 4,
                'coefficient' => 6,
            ),
            2 => 
            array (
                'id' => 3,
                'classe_id' => 1,
                'matiere_id' => 1,
                'coefficient' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'classe_id' => 1,
                'matiere_id' => 3,
                'coefficient' => 2,
            ),
            4 => 
            array (
                'id' => 5,
                'classe_id' => 1,
                'matiere_id' => 5,
                'coefficient' => 2,
            ),
            5 => 
            array (
                'id' => 6,
                'classe_id' => 1,
                'matiere_id' => 8,
                'coefficient' => 2,
            ),
            6 => 
            array (
                'id' => 7,
                'classe_id' => 1,
                'matiere_id' => 10,
                'coefficient' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'classe_id' => 2,
                'matiere_id' => 2,
                'coefficient' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'classe_id' => 2,
                'matiere_id' => 4,
                'coefficient' => 6,
            ),
            9 => 
            array (
                'id' => 10,
                'classe_id' => 2,
                'matiere_id' => 1,
                'coefficient' => 3,
            ),
            10 => 
            array (
                'id' => 11,
                'classe_id' => 2,
                'matiere_id' => 3,
                'coefficient' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'classe_id' => 2,
                'matiere_id' => 5,
                'coefficient' => 2,
            ),
            12 => 
            array (
                'id' => 13,
                'classe_id' => 2,
                'matiere_id' => 8,
                'coefficient' => 2,
            ),
            13 => 
            array (
                'id' => 14,
                'classe_id' => 2,
                'matiere_id' => 10,
                'coefficient' => 0,
            ),
        ));
        
        
    }
}