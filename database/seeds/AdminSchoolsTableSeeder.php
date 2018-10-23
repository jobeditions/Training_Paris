<?php

use Illuminate\Database\Seeder;

class AdminSchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('school_admin')->insert([
          'admin_id' => 1,
          'school_id' => 1
      ]);
    }
}
