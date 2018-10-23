<?php

use Illuminate\Database\Seeder;

class SchoolsStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('school_student')->insert([
            'school_id' => 2,
            'student_id' => 1,
        ]);
        DB::table('school_student')->insert([
            'school_id' => 2,
            'student_id' => 3,
        ]);
    }
}
