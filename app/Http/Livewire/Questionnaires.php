<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;

class Questionnaires extends Component
{
    /**
     * Show / Hide modal flag
     */
    public $showUpsertModal = false;

    /**
     * A modeled properties for the model
     */
    public $title;
    public $slug;
    public $min_age;
    public $description;

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

    public function mount()
    {
        
    }

    /**
     * Rendering the component
     */
    public function render()
    {
        return view('livewire.questionnaires');
    }


    /**
     * Persist a new questionnaire to the database
     */
    public function addQuestionnaire()
    {
        $data = $this->validate();
        
        if(!is_null(Auth::user()))
            Auth::user()->questionnaires()->create($data);

        $this->toggleShowUpsertModal();
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

    private function toggleShowUpsertModal()
    {
        $this->showUpsertModal = !$this->showUpsertModal;
    }

}
