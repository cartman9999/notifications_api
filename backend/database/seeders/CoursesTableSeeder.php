<?php

namespace Database\Seeders;

use App\Models\{Course};
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Fundraising 101: Introduction to Fundraising',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'author' => 'TED x Talks',
            'video_url' => 'https://www.youtube.com/watch?v=GsvSWkEHNDk&ab_channel=TEDxTalks' 
        ]);
        
        Course::create([
            'name' => 'Fundraising 202: Mastering the basics',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'author' => 'Amber Melanie Smith',
            'video_url' => 'https://www.youtube.com/watch?v=-HeFuJRb1N4&ab_channel=AmberMelanieSmith' 
        ]);

        Course::create([
            'name' => 'Fundraising for Executive Directors',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'author' => 'Charity Village',
            'video_url' => 'https://www.youtube.com/watch?v=eBG1VaYRj4w&ab_channel=CharityVillage' 
        ]);    
    }
    
}
