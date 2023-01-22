<?php

namespace Database\Seeders;

use App\Http\Traits\CompanyTrait;
use App\Models\{User, Organization};
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    use CompanyTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get Organization's
        $organizations = Organization::get(['id', 'name']);

        // Create Admin's
        User::create([
            'name' => 'Admin',
            'last_name' => $organizations[0]->name,
            'email' =>  $this->createCompanyEmail(null, $organizations[0]->name),
            'password' => bcrypt('password'),
            'role_id' => 1,
            'organization_id' => 1,
            'access_token' => uniqid('user_', true)
        ]);

        User::create([
            'name' => 'Admin',
            'last_name' => $organizations[1]->name,
            'email' =>  $this->createCompanyEmail(null, $organizations[1]->name),
            'password' => bcrypt('password'),
            'role_id' => 1,
            'organization_id' => 2,
            'access_token' => uniqid('user_', true)
        ]);

        // Create team members
        \App\Models\User::factory(2)->create([
            'organization_id' => 1,
            'role_id' => 2
        ]);

        \App\Models\User::factory(2)->create([
            'organization_id' => 2,
            'role_id' => 2
        ]);
    }
}
