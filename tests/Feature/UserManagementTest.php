<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @group users */
    public function test_admin_can_view_all_users()
    {
        $this->withoutExceptionHandling();
        
        $role = Role::firstOrCreate(
            ['title' => 'Admin'],
            ['description' => 'Should have all the permissions'],
        );

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));

        $response = $this->get(route('admin.users.index'));

        $response->assertOk();

        $response->assertViewIs('admin.users.index');

        $response->assertSeeLivewire('users');
    }
}
