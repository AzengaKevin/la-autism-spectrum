<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use App\Models\Questionnaire;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuestionnaireVideoManagementTest extends TestCase
{
    use RefreshDatabase;
    
    private ?User $user;

    public function setUp() : void
    {
        parent::setUp();
        
        $this->be($this->user = User::factory()->create());
    }
    
    /** @group questionnaire-video */
    public function test_an_expert_can_view_own_questionnaires_video()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        $response = $this->get(route('expert.questionnaires.videos.index', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('expert.videos.index');

        $response->assertViewHas('questionnaire');
        
    }

    /** @group questionnaire-video */
    public function test_expert_can_view_a_page_to_add_own_questionnaire_video()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        $response = $this->get(route('expert.questionnaires.videos.create', $questionnaire));

        $response->assertOk();

        $response->assertViewIs('expert.videos.create');

        $response->assertViewHas('questionnaire');        
    }

    /** @group questionnaire-video */
    public function test_expert_can_add_a_video_to_own_questionnaire()
    {
        //Arrange
        $this->withoutExceptionHandling();
        
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        Storage::fake('public');

        $file = UploadedFile::fake()->create(
            'video.mp4', 40960, 'video/mpeg'
        );

        //Act
        $response = $this->post(route('expert.questionnaires.videos.store', $questionnaire), [
            'description' => 'Some description',
            'video' => $file
        ]);

        //Assert
        $this->assertCount(1, Video::all());
        $this->assertNotNull($questionnaire->video);

        Storage::disk('public')->assertExists($questionnaire->video->path);

        $response->assertRedirect(route('expert.questionnaires.videos.index', $questionnaire));
 
    }

    /** @group questionnaire-video */
    public function test_expert_can_view_edit_page_for_own_questionnaire_video()
    {
        //Arrange
        $this->withoutExceptionHandling();
                
        $questionnaireData = Questionnaire::factory()->make()->toArray();

        $questionnaire = $this->user->questionnaires()->create($questionnaireData);

        $video = $questionnaire->video()->create([
            'description' => 'Test Description', 
            'path' => 'somepath.mp4'
        ]);
       
        //Act
        $response = $this->get(route('expert.questionnaires.videos.edit', [
            'questionnaire' => $questionnaire,
            'video' => $video
        ]));

        //Assertions
        $response->assertOk();

        $response->assertViewIs('expert.videos.edit');

        $response->assertViewHasAll(['questionnaire', 'video']);
        
    }
}
