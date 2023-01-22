<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Role};

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'role' => 'admin' ], 
            [ 'role' => 'team_member' ]
        ];

        Role::insert($roles);
    }
}
