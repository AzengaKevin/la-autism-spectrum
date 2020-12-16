<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Models\Questionnaire;
use App\Http\Livewire\Questionnaires;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RxQuestionnaireTest extends TestCase
{
    use RefreshDatabase;

    /** @group questionnaires */
    public function test_a_questionnaire_can_be_created()
    {
        $this->be($user = User::factory()->create());

        $questionnaireData = Questionnaire::factory()->make()->toArray();

        Livewire::test(Questionnaires::class)
            ->set('title', $questionnaireData['title'])
            ->set('min_age', $questionnaireData['min_age'])
            ->set('description', $questionnaireData['description'])
            ->call('createQuestionnaire');

        $this->assertCount(1, Questionnaire::all());
        $this->assertTrue(Questionnaire::where('slug', Str::slug($questionnaireData['title']))->exists());

        $this->assertEquals($questionnaireData['title'], QUestionnaire::first()->title);
        $this->assertEquals($questionnaireData['min_age'], QUestionnaire::first()->min_age);
        $this->assertEquals($questionnaireData['description'], QUestionnaire::first()->description);
        $this->assertEquals($user->id, Questionnaire::first()->user_id);
    }

    /** @group questionnaires */
    public function test_a_questionnaire_can_be_updated_by_the_owner()
    {
        $this->be($user = User::factory()->create());

        //Questionnaire::factory()->create(['user_id' => $user->id]);

        $questionnaireData = Questionnaire::factory()->make()->toArray();

        Livewire::test(Questionnaires::class)
            ->set('title', $questionnaireData['title'])
            ->set('min_age', $questionnaireData['min_age'])
            ->set('description', $questionnaireData['description'])
            ->call('createQuestionnaire');

        $this->assertCount(1, Questionnaire::all());
        $this->assertTrue(Questionnaire::where('slug', Str::slug($questionnaireData['title']))->exists());

        $this->assertEquals($questionnaireData['title'], QUestionnaire::first()->title);
        $this->assertEquals($questionnaireData['min_age'], QUestionnaire::first()->min_age);
        $this->assertEquals($questionnaireData['description'], QUestionnaire::first()->description);
        $this->assertEquals($user->id, Questionnaire::first()->user_id);        
    }
}

