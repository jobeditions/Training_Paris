<?php

use Illuminate\Database\Seeder;

class SchoolAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('school_admin')->insert([
          'school_id' => 2,
          'admin_id' => 1,
      ]);
    }
}
