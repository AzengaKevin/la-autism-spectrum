<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Questionnaire;
use App\Http\Livewire\Pictures;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionnairePicturesManagementTest extends TestCase
{
    use RefreshDatabase;
    
    private ?User $user;

    public function setUp() : void
    {
        parent::setUp();
        
        $this->be($this->user = User::factory()->create());
    }
    
    /** @group questionnaire-pictures */
    public function test_an_expert_can_view_own_questionnaires_pictures()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        $response = $this->get(route('expert.questionnaires.pictures.index', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('expert.pictures.index');

        $response->assertSeeLivewire('pictures');

        $response->assertViewHas('questionnaire');
        
    }

    /** @group questionnaire-pictures */
    public function test_an_expert_can_add_picture_to_own_questionnaire()
    {
        //Arrange
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.png');
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        //Act
        Livewire::test(Pictures::class)
            ->call('mount', $questionnaire)
            ->set('picture', $file)
            ->set('alt', 'The best image description')
            ->call('createPicture');

        //Assert

        $this->assertCount(1, $questionnaire->pictures);

        Storage::disk('public')->assertExists($questionnaire->pictures->first()->path);
        Storage::disk('public')->assertExists($questionnaire->pictures->first()->thmbnail);
    }
}
