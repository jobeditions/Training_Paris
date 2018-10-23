<?php
/**
 * Copyright (c) Liigem 2016.
 */
/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 31/08/2016
 * Time: 09:33
 */
use Illuminate\Database\Seeder;

class VersionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('versions')->insert([
            'version_number' => 0.00,
            'update' => 'First version',
        ]);
        DB::table('versions')->insert([
            'version_number' => 0.01,
            'update' => 'Fixed',
        ]);

    }
}