<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'B11',
          'numero' => 'B11'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'B12',
          'numero' => 'B12'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'B13',
          'numero' => 'B13'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'B21',
          'numero' => 'B21'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'Salle informatique',
          'numero' => '403'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'Salle polyvalente 1',
          'numero' => 'SP1'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'Gymnase',
          'numero' => 'GYM'
      ]);

      DB::table('rooms')->insert([
          'school_id' => 2,
          'name' => 'Salle bis',
          'numero' => 'Bis1'
      ]);
    }
}
