<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Answer;
use App\Models\Screening;
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

    /** @group screening */
    public function test_public_can_submit_a_screening()
    {
        $this->withoutExceptionHandling();
        
        Questionnaire::factory()
            ->times(2)
            ->hasQuestions(4)
            ->create();
        
        Answer::factory()->create();

        $questionnaire = Questionnaire::first();

        $questions = $questionnaire->questions->pluck('id')->toArray();

        $data = [];

        foreach ($questions as $question) {
            $data[] = [
                'question_id' => $question,
                'answer_id' => 1,
            ];
        }
            
        $response = $this->post(route('screenings.store', $questionnaire), [
            'respondent' => [
                'name' => 'Azenga Kevin', 
                'email' => 'azenga.kevin7@gmail.com'
            ],
            'responses' => $data
        ]);

        $this->assertTrue(Screening::where('questionnaire_id', $questionnaire->id)->exists());
        $this->assertCount(4, Screening::where('questionnaire_id', $questionnaire->id)->first()->responses);

        $response->assertRedirect(route('screenings.index'));
        
    }
}
