<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserQuestionnaireManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void 
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /** @group questionnaires */
    public function test_an_autheticated_user_can_manage_questionnaires()
    {
        
        $role = Role::firstOrCreate(
            ['title' => 'Admin'],
            ['description' => 'Should have all the permissions'],
        );

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));

        $response = $this->get(route('admin.questionnaires'));

        $response->assertOk();

        $response->assertViewIs('admin.questionnaires.index');

        $response->assertSeeLivewire('questionnaires');

    }

    /** @group questionnaires */
    public function test_a_user_must_be_authenticated_to_manage_questionnaires()
    {
        
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $response = $this->get(route('admin.questionnaires'));

    }

}
