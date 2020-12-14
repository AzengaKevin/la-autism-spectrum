<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @group settings */
    public function test_an_authenticated_user_can_visit_settings()
    {
        $this->actingAs(User::factory()->create());
        
        $this->withoutExceptionHandling();

        $response = $this->get(route('settings.show'));

        $response->assertViewIs('settings.show');

        $response->assertOk();
    }
}
