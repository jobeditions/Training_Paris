<?php
/**
 * Copyright (c) Liigem 2016.
 */

/**
 * Created by PhpStorm.
 * User: Nathanael
 * Date: 21/12/2016
 * Time: 22:47
 */
use Illuminate\Database\Seeder;

class InvitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invites')->insert([
            'email' => 'nathanael.langlois@gmail.com',
            'code' =>  str_random(25),
            'from_id'=>\App\User::where('name','Nathanaël')->first()->id
        ]);
        DB::table('invites')->insert([
            'email' => 'chuck.bartowski@liigem.io',
            'code' =>  str_random(25),
            'from_id'=>\App\User::where('name','Nathanaël')->first()->id,
            'status' => 'completed'
        ]);
    }
}
