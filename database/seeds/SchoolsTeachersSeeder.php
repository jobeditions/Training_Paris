<?php

use Illuminate\Database\Seeder;

class SchoolsTeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('school_teacher')->insert([
            'teacher_id' => 1,
            'school_id' => 1,
        ]);
        DB::table('school_teacher')->insert([
            'teacher_id' => 1,
            'school_id' => 2,
        ]);
        DB::table('school_teacher')->insert([
            'teacher_id' => 2,
            'school_id' => 2,
        ]);
    }
}
