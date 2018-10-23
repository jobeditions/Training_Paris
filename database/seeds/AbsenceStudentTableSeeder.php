<?php
/**
 * Copyright (c) Liigem 2017.
 */

use Illuminate\Database\Seeder;

class AbsenceStudentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('absence_student')->delete();


    }
}