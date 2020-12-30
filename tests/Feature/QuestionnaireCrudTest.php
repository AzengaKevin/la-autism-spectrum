<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Questionnaire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionnaireCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group questionnaire */
    public function test_a_questionnaire_can_be_created()
    {
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = Questionnaire::create($questionnaireData);

        $this->assertCount(1, Questionnaire::all());

        $this->assertEquals($questionnaireData['title'], $questionnaire->title);
        $this->assertEquals($questionnaireData['user_id'], $questionnaire->user_id);
        $this->assertEquals($questionnaireData['age'], $questionnaire->age);
    }

    /** @group questionnaires */
    public function test_a_questionnaire_can_be_read()
    {
        Questionnaire::factory()->create();

        $questionnaire = Questionnaire::find(1);

        $this->assertNotNull($questionnaire);
    }

    /** @group questionnaire */
    public function test_a_questionnaire_can_be_updated()
    {
        Questionnaire::factory()->create();

        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = Questionnaire::find(1);

        $this->assertNotNull($questionnaire);

        $questionnaire->update($questionnaireData);

        $this->assertEquals($questionnaireData['title'], $questionnaire->title);
        $this->assertEquals($questionnaireData['user_id'], $questionnaire->user_id);
        $this->assertEquals($questionnaireData['age'], $questionnaire->age);
        
    }

    /** @group questionnaires */
    public function test_a_questionnaire_can_be_deleted()
    {
        Questionnaire::factory()->create();

        $questionnaire = Questionnaire::find(1);
        $questionnaire->delete();

        $this->assertCount(0, Questionnaire::all());

        $this->assertCount(1, Questionnaire::withTrashed()->get());
        
    }
}
