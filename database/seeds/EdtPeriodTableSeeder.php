<?php
/**
 * Copyright (c) Liigem 2017.
 */

/**
 * User: Baptiste
 * Date: 08/11/2016
 * Time: 18:41
 */
use Illuminate\Database\Seeder;

class EdtPeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edt_periods')->insert([
            'start' => '08:15:00',
            'end' => '09:10:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '09:10:00',
            'end' => '10:05:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '10:05:00',
            'end' => '10:20:00',
            'label' => "Récréation"
        ]);
        DB::table('edt_periods')->insert([
            'start' => '10:20:00',
            'end' => '11:15:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '11:15:00',
            'end' => '12:10:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '12:10:00',
            'end' => '13:05:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '13:05:00',
            'end' => '14:00:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '14:00:00',
            'end' => '14:55:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '14:55:00',
            'end' => '15:50:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '15:50:00',
            'end' => '16:00:00',
            'label' => 'Récréation'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '16:00:00',
            'end' => '16:55:00'
        ]);
        DB::table('edt_periods')->insert([
            'start' => '16:55:00',
            'end' => '17:50:00'
        ]);
    }
}
