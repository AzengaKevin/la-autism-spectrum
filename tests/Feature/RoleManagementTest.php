<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Roles;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @group roles */
    public function test_admin_can_manage_role()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $response = $this->get(route('roles.index'));

        $response->assertOk();

        $response->assertViewIs('roles.index');

        $response->assertSeeLivewire('roles');
    }

    /** @group roles */
    public function test_a_role_can_be_created()
    {
        $this->withoutExceptionHandling();

        $roleData = Role::factory()->make()->toArray();

        Livewire::test(Roles::class)
            ->set('title', $roleData['title'])
            ->set('description', $roleData['description'])
            ->call('createRole');

        $this->assertTrue(Role::where('title', $roleData['title'])->exists());
    }

    /** @group roles */
    public function test_a_role_can_be_successfully_updated()
    {
        $this->withoutExceptionHandling();

        $role = Role::factory()->create();

        $roleData = Role::factory()->make()->toArray();

        Livewire::test(Roles::class)
            ->call('showEditRoleModal', $role)
            ->set('title', $roleData['title'])
            ->call('updateRole');

        $this->assertTrue(Role::where('title', $roleData['title'])->exists());
        
    }

    /** @group roles */
    public function test_a_role_can_be_delete()
    {
        $this->withoutExceptionHandling();

        $role = Role::factory()->create();

        Livewire::test(Roles::class)
            ->call('showConfirmRoleDeletionModal', $role)
            ->call('deleteRole');

        $this->assertFalse(Role::where('title', $role->title)->exists());
    }
}
