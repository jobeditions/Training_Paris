<?php

use Illuminate\Database\Seeder;

class NotesStudentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notes_students')->delete();
        
        \DB::table('notes_students')->insert(array (
            0 => 
            array (
                'id' => 1,
                'note' => 18.5,
                'note_ref' => 1,
                'student_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'note' => 15,
                'note_ref' => 2,
                'student_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'note' => 13,
                'note_ref' => 1,
                'student_id' => 2,
            ),
        ));
        
        
    }
}