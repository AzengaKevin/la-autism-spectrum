<?php

namespace Tests\Feature\Expert;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScreeningsManagementTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp() : void
    {
        parent::setUp();

        $role = Role::firstOrCreate(['title' => 'Expert']);

        $this->actingAs(User::factory()->create(['role_id' => $role->id]));        

    }

    /** @group expert-screenings */
    public function test_a_expert_can_view_screenings_for_own_questionnaire()
    {
        //Arrange
        $this->withoutExceptionHandling();

        //Act
        $response = $this->get(route('expert.screenings.index'));

        //Assert
        $response->assertOk();

        $response->assertViewIs('expert.screenings.index');

        $response->assertViewHas('screenings');
    }
}
