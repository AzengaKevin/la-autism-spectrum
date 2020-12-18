<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionnaireQuestionsMgtTest extends TestCase
{

    use RefreshDatabase;

    /** @group questions */
    public function test_a_questionnaire_owner_can_see_questionnaires()
    {
        //Arrange
        $this->withoutExceptionHandling();

        User::factory()
            ->times(2)
            ->hasQuestionnaires(10)
            ->create();

        $this->actingAs($user = User::first());

        $response = $this->get(route('questionnaires.questions.index', $user->questionnaires->first()));

        $response->assertOk();

        $response->assertViewIs('questions.index');

        $response->assertViewHas('questionnaire');

    }

    /** @group questions */
    public function test_a_create_question_page_for_a_questionnaire_can_be_viewed()
    {
        //Arrange
        $this->withoutExceptionHandling();

        User::factory()
            ->times(1)
            ->hasQuestionnaires(2)
            ->create();
            
        $this->be($user = User::first());

        $response = $this->get(route('questionnaires.questions.create', $user->questionnaires->first()));

        $response->assertOk();
        $response->assertViewIs('questions.create');
        $response->assertViewHas('questionnaire');
        $response->assertSeeLivewire('question-create');
    }

    /** @group questions */
    public function test_a_question_can_be_created_for_a_questionnaire()
    {
        //Arrange
        $this->withoutExceptionHandling();

        User::factory()
            ->times(1)
            ->hasQuestionnaires(2)
            ->create();

        $this->be($user = User::first());
        
        $question = Question::factory()->make()->toArray();
        unset($question['questionnaire_id']);
        $answers = Answer::factory()->times(4)->make()->toArray();

        $response = $this->post(route('questionnaires.questions.store', $user->questionnaires->first()),[
            'question' => $question,
            'answers' => $answers,
        ]);

        $this->assertCount(1, $user->questionnaires->first()->questions);
        $this->assertCount(4, $user->questionnaires->first()->questions->first()->answers);

        $response->assertRedirect(route('questionnaires.questions.index', $user->questionnaires->first()));
    }
}
