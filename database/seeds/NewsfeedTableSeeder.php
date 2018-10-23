<?php

use Illuminate\Database\Seeder;

class NewsfeedTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('newsfeed')->delete();
        
        \DB::table('newsfeed')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Demo 1',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.',
				'author' => \App\User::where('name', 'Nathanaël')->first()->id,
                'start_date' => NULL,
                'end_date' => '2017-12-12 00:00:00',
                'visible' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Demo 2',
                'content' => 'Suspendisse ultrices nisl vitae hendrerit porttitor. Morbi risus sapien.',
				'author' => \App\User::where('name', 'Nathanaël')->first()->id,
                'start_date' => NULL,
                'end_date' => '2017-12-12 00:00:00',
                'visible' => 1,
            ),
        ));
        
        
    }
}