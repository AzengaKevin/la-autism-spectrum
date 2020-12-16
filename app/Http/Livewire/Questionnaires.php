<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Questionnaires extends Component
{
    use WithPagination;

    /**
     * Show / Hide updating and inserting modal flag
     */
    public $showUpsertModal = false;

    /**
     * Show / Hide deleting modal flag
     */
    public $showDeleteModal = false;


    /**
     * A modeled properties for the model
     */
    public $title;
    public $slug;
    public $min_age;
    public $description;

    public $questionnaireId;
    public $questionnaireTitle;

    /**
     * Validation rules
     */
    protected $rules = [
        'title' => ['bail', 'required', 'max:255', 'string'],
        'slug' => ['bail', 'required', 'unique:questionnaires,slug'],
        'min_age' => ['bail', 'required', 'between:1,100', 'numeric'],
        'description' => ['bail', 'required', 'between:40,200', 'string'],
    ];   
    
    
    protected $validationAttributes = [
        'title' => 'title',
        'slug' => 'slug',
        'min_age' => 'minimum age',
        'description' => 'description',
    ];

    /**
     * Livewire mount function called when the component is mounting
     */
    public function mount()
    {
        
    }

    /**
     * Rendering the component
     */
    public function render()
    {
        return view('livewire.questionnaires', ['questionnaires' => $this->readQuestionnaires()]);
    }


    /**
     * Persist a new questionnaire to the database
     */
    public function createQuestionnaire()
    {
        $data = $this->validate();
        
        if(!is_null(Auth::user()))
            Auth::user()->questionnaires()->create($data);

        $this->toggleShowUpsertModal();
    }

    /**
     * Return questionnaires that belong to the then authenticated user
     */
    public function readQuestionnaires()
    {
        return Auth::user()->questionnaires;
    }

    /**
     * Persists the questionnaire changes to the database
     */
    public function updateQuestionnaire()
    {
        if(!is_null($this->questionnaireId)){
            
            $data = $this->validate();
    
            Questionnaire::findOrFail($this->questionnaireId)
                ->update($data);

            $this->toggleShowUpsertModal();
        }
    }

    /**
     * Updates the slug when the title is updated
     */
    public function updatedTitle($title)
    {
        $this->slug = Str::slug($title);
    }

    /**
     * Clear the validation errors and reset properties when the modal is closed
     */
    public function updatedShowUpsertModal($flag)
    {
        if(!$flag){
            $this->resetValidation();
            $this->reset();
        }
    }

    /**
     * Update properties when an item is deleted
     */
    public function updatedShowDeleteModal($flag)
    {
        if(!$flag){
            $this->reset();
        }
    }

    /**
     * Inverts the current boolean value of showUpsertModal property
     */
    private function toggleShowUpsertModal()
    {
        $this->showUpsertModal = !$this->showUpsertModal;
    }

    /**
     * Inverts the current value of showDeleteModal property
     */
    public function toggleShowDeleteModal()
    {
        $this->showDeleteModal = !$this->showDeleteModal;
    }


    /**
     * Update the required properties and show the update modal
     */
    public function showEditQuestionnaireModal(Questionnaire $questionnaire)
    {

        $this->questionnaireId = $questionnaire->id;
        $this->questionnaireTitle =  $this->title = $questionnaire->title;
        $this->slug = $questionnaire->slug;
        $this->min_age = $questionnaire->min_age;
        $this->description = $questionnaire->description;

        $this->toggleShowUpsertModal();
    }

    /**
     * Update the required properties and shoe the deleting modal
     */
    public function showConfirmQuestionnaireDeletionModal(Questionnaire $questionnaire)
    {
        $this->questionnaireId = $questionnaire->id;
        $this->questionnaireTitle =  $this->title = $questionnaire->title;

        $this->toggleShowDeleteModal();
    }

    /**
     * Delete the questionnaire entry from the database
     */
    public function deleteQuestionnaire()
    {

        if(!is_null($this->questionnaireId)){
            Questionnaire::findOrFail($this->questionnaireId)->delete();
            Log::info('Questionnaire deleted');
        }

    }

}