<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Questionnaires;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RxQuestionnaireTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void 
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /** @group questionnaires */
    public function test_a_questionnaire_can_be_created()
    {
        $this->withoutExceptionHandling();
        
        $role = Role::firstOrCreate(
            ['title' => 'Admin'],
            ['description' => 'Should have all the permissions'],
        );

        $this->be($user = User::factory()->create(['role_id' => $role->id]));

        $questionnaireData = Questionnaire::factory()->make()->toArray();

        Livewire::test(Questionnaires::class)
            ->set('title', $questionnaireData['title'])
            ->set('age', $questionnaireData['age'])
            ->set('type', $questionnaireData['type'])
            ->call('createQuestionnaire');

        $this->assertCount(1, Questionnaire::all());
        $this->assertTrue(Questionnaire::where('slug', Str::slug($questionnaireData['title']))->exists());

        $this->assertEquals($questionnaireData['title'], Questionnaire::first()->title);
        $this->assertEquals($questionnaireData['age'], Questionnaire::first()->age);
        $this->assertEquals($questionnaireData['description'], Questionnaire::first()->description);
        $this->assertEquals($user->id, Questionnaire::first()->user_id);
    }

    /** @group questionnaires */
    public function test_a_questionnaire_can_be_updated_by_the_owner()
    {
        $this->be($user = User::factory()->create());

        $questionnaire = Questionnaire::factory()->create(['user_id' => $user->id]);

        $questionnaireData = Questionnaire::factory()->make()->toArray();

        Livewire::test(Questionnaires::class)
            ->call('showEditQuestionnaireModal', $questionnaire)
            ->set('title', $questionnaireData['title'])
            ->set('slug', 'test')
            ->set('type', 'video')
            ->set('age', $questionnaireData['age'])
            ->call('updateQuestionnaire');

        $this->assertCount(1, Questionnaire::all());
        //$this->assertTrue(Questionnaire::where('slug', Str::slug($questionnaireData['title']))->exists());
        $this->assertTrue(Questionnaire::where('slug', 'test')->exists());

        $this->assertEquals($questionnaireData['title'], Questionnaire::first()->title);
        $this->assertEquals($questionnaireData['age'], Questionnaire::first()->age);
        $this->assertEquals($user->id, Questionnaire::first()->user_id);        
    }


    /** @group questionnaires */
    public function test_a_questionnaire_can_be_archived()
    {
        $this->be($user = User::factory()->create());

        $questionnaire = Questionnaire::factory()->create(['user_id' => $user->id]);
        
        $this->assertCount(1, Auth::user()->questionnaires);

        Livewire::test(Questionnaires::class)
            ->call('showConfirmQuestionnaireDeletionModal', $questionnaire)
            ->call('deleteQuestionnaire');

        $this->assertCount(0, Questionnaire::all());
        $this->assertFalse(Questionnaire::where('slug', 'test')->exists());

    }
}

