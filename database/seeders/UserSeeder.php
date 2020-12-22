<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(
            ['title' => 'Admin'],
            ['description' => 'Should have all the permissions'],
        );

        $defaultRole = Role::firstOrCreate(
            ['title' => 'Default'],
            ['description' => 'No permission at all'],
        );

        User::factory(10)->create(['role_id' => $defaultRole->id]);

        User::factory()->create([
            'name' => 'Azenga Kevin', 
            'email' => 'azenga.kevin7@gmail.com', 
            'role_id' => $adminRole->id
        ]);
    }
}
