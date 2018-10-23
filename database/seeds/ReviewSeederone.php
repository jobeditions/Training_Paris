<?php

use Illuminate\Database\Seeder;

class ReviewSeederone extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Review::create([
            
           
            'id' => '1',
            'review' => '"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text"',
            'student_id' => '11',
            'teacher_id' => '2',
            'class_id' => '1',
            'featured' => '/images/seed/img12.jpg',
            'category_id' => '1',
        ]);
    }
    }
}
