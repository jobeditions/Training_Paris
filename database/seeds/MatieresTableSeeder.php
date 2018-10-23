<?php

use Illuminate\Database\Seeder;

class MatieresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('matieres')->delete();
        
        \DB::table('matieres')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Français',
                'description' => 'Français',
                'short_name' => 'Français',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Mathématiques',
                'description' => 'Mathématiques',
                'short_name' => 'Maths',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Education Physique et Sportive',
                'description' => 'Education Physique et Sportive',
                'short_name' => 'EPS',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Anglais',
                'description' => 'Anglais',
                'short_name' => 'Anglais',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Espagnol',
                'description' => 'Espagnol',
                'short_name' => 'Espagnol',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Sciences de la Vie et de la Terre',
                'description' => 'Sciences de la Vie et de la Terre',
                'short_name' => 'SVT',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Sciences Physiques',
                'description' => 'Sciences Physiques',
                'short_name' => 'Sc. Physiques',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Histoire-Géographie',
                'description' => 'Histoire-Géographie',
                'short_name' => 'Histoire-Géo',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Arts Plastiques',
                'description' => 'Arts Plastiques',
                'short_name' => 'Arts',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Latin',
                'description' => 'Latin',
                'short_name' => 'Latin',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Grec',
                'description' => 'Grec',
                'short_name' => 'Grec',
            ),
        ));
        
        
    }
}