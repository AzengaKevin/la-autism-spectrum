<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserQuestionnaireManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @group questionnaires */
    public function test_an_autheticated_user_can_manage_questionnaires()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('questionnaires'));

        $response->assertOk();

        $response->assertSeeLivewire('questionnaires');

    }

    /** @group questionnaires */
    public function test_a_user_must_be_authenticated_to_manage_questionnaires()
    {
        
        $this->withoutExceptionHandling();
        $this->expectException(AuthenticationException::class);

        $response = $this->get(route('questionnaires'));

    }

}
