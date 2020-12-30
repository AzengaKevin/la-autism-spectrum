<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionnaireQuestionsManagementTest extends TestCase
{

    use RefreshDatabase;

    private ?User $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->actingAs($this->user = User::factory()->create());

    }

    /** @group questionnaire-questions */
    public function test_an_expert_can_view_on_questionnaires_questions()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        $response = $this->get(route('expert.questionnaires.questions.index', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('expert.questions.index');

        $response->assertViewHas('questionnaire');

    }

    /** @group questionnaire-questions */
    public function test_an_expert_can_view_create_questionnaire_question_page()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        $response = $this->get(route('expert.questionnaires.questions.create', $questionnaire));

        $response->assertOk();
        $response->assertViewIs('expert.questions.create');
        $response->assertViewHas('questionnaire');
        $response->assertSeeLivewire('question-create');
    }

    /** @group questionnaire-questions */
    public function test_an_expert_can_create_question_for_own_questionnaire()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);
        
        $question = Question::factory()->make()->toArray();

        unset($question['questionnaire_id']);

        $answers = Answer::factory()->times(4)->make()->toArray();

        $response = $this->post(route('expert.questionnaires.questions.store', $questionnaire),[
            'question' => $question,
            'answers' => $answers,
        ]);

        $this->assertCount(1, $questionnaire->questions);
        $this->assertCount(4, $questionnaire->questions->first()->answers);

        $response->assertRedirect(route('expert.questionnaires.questions.index', $questionnaire));
    }
}
