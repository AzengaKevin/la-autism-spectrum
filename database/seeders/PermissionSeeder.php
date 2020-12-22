<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create-role',
            'read-role',
            'update-role',
            'delete-role',

            'create-questionnaire',
            'read-questionnaire',
            'update-questionnaire',
            'delete-questionnaire',

            'create-user',
            'read-user',
            'update-user',
            'delete-user',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['title' => $permission]);
        }

        $role = Role::firstOrCreate(
            ['title' => 'Admin'],
            ['description' => 'Should have all the permissions'],
        );

        $role->permissions()->sync(Permission::pluck('id')->toArray());
    }
}
