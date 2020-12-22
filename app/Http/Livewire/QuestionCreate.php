<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class QuestionCreate extends Component
{
    use WithFileUploads;
    
    public $questionnaire;

    public $photo;

    public $answers = [''];
    
    public function render()
    {
        return view('livewire.question-create');
    }

    public function addAnswerField()
    {
        if(count($this->answers) < 4)
            $this->answers[] = '';
    }

    public function deleteAnswerField(int $index)
    {
        unset($this->answers[$index]);

        $this->answers = array_values($this->answers);
    }

    public function updatedPhoto($photo)
    {
        info("Photo Update");
    }
}
