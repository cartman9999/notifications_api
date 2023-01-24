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
            'video_url' => 'https://www.youtube.com/embed/GsvSWkEHNDk' 
        ]);
        
        Course::create([
            'name' => 'Fundraising 202: Mastering the basics',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'author' => 'Amber Melanie Smith',
            'video_url' => 'https://www.youtube.com/embed/-HeFuJRb1N4' 
        ]);

        Course::create([
            'name' => 'Fundraising for Executive Directors',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'author' => 'Charity Village',
            'video_url' => 'https://www.youtube.com/embed/eBG1VaYRj4w' 
        ]);    
    }
    
}
