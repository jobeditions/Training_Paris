<?php

use Illuminate\Database\Seeder;

class TeachersMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('teachers_messages')->insert([
            'teacher_id' => 2,
            'assignment_id' => 1,
            'message' => "N'hésitez pas à m'envoyer un message si vous avez besoin d'aide :)"
        ]);
    }
}
