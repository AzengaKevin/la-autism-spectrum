<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Questionnaire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicScreeningTest extends TestCase
{
    use RefreshDatabase;

    /** @group screening */
    public function test_public_can_view_all_the_screening_questionnaires()
    {
        $this->withoutExceptionHandling();
        
        Questionnaire::factory()
            ->times(10)
            ->hasQuestions(4)
            ->create();

        $response = $this->get(route('screenings.index'));

        $response->assertOk();
    }

    /** @group screening */
    public function test_public_can_view_a_single_questionnaire()
    {
        $this->withoutExceptionHandling();
        
        Questionnaire::factory()
            ->times(2)
            ->hasQuestions(4)
            ->create();

        $response = $this->get(route('screenings.show', Questionnaire::first()));

        $response->assertOk();
    }
}
