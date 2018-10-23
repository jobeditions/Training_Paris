<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 08/11/2016
 * Time: 18:41
 */
use Illuminate\Database\Seeder;

class EtabTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'app/developer_docs/etab_france_2016.sql';
        DB::unprepared(file_get_contents($path));
    }
}
