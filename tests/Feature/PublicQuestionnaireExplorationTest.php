<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Answer;
use App\Models\Screening;
use App\Models\Questionnaire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicQuestionnaireExplorationTest extends TestCase
{
    use RefreshDatabase;

    /** @group public-questionnaires */
    public function test_public_can_view_all_the_questionnaires()
    {
        $this->withoutExceptionHandling();
        
        Questionnaire::factory()
            ->times(5)
            ->hasQuestions(4)
            ->create();

        $response = $this->get(route('questionnaires.index'));

        $response->assertOk();

        $response->assertViewIs('questionnaires.index');

        $response->assertViewHas('questionnaires');
    }

    /** @group public-questionnaires */
    public function test_public_can_view_questionnaire_questions()
    {
        $this->withoutExceptionHandling();
        
        $questionnaire = Questionnaire::factory()
            ->hasQuestions(4)
            ->create();

        $response = $this->get(route('questionnaires.questions.index', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('questions.index');

        $response->assertViewHas('questionnaire');
        
    }

    /** @group public-questionnaires */
    public function test_public_can_view_questionnaire_pictures()
    {
        $this->withoutExceptionHandling();
        
        $questionnaire = Questionnaire::factory()
            ->hasQuestions(4)
            ->create();

        $video = $questionnaire->pictures()->create([
            'alt' => 'Test Description', 
            'path' => 'path.jpg',
            'thumbnail' => 'thumbnail.jpg'
        ]);

        $response = $this->get(route('questionnaires.pictures.index', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('pictures.index');

        $response->assertViewHas('questionnaire');
        
    }

    /** @group public-questionnaires */
    public function test_public_can_view_questionnaire_video()
    {
        $this->withoutExceptionHandling();
        
        $questionnaire = Questionnaire::factory()
            ->hasQuestions(4)
            ->create();

        $video = $questionnaire->video()->create([
            'description' => 'Test Description', 
            'path' => 'somepath.mp4'
        ]);

        $response = $this->get(route('questionnaires.videos.index', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('videos.index');

        $response->assertViewHas('questionnaire');
        
    }

    /** @group public-questionnaires */
    public function test_public_can_submit_a_questionnaire_response()
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
            
        $response = $this->post(route('questionnaires.screenings.store', $questionnaire), [
            'respondent' => [
                'name' => 'Azenga Kevin', 
                'email' => 'azenga.kevin7@gmail.com'
            ],
            
            'responses' => $data
        ]);

        $this->assertTrue(Screening::where('questionnaire_id', $questionnaire->id)->exists());
        $this->assertCount(4, Screening::where('questionnaire_id', $questionnaire->id)->first()->responses);

        $response->assertRedirect(route('questionnaires.index'));
        
    }
}
