<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QuestionCreate extends Component
{
    public $questionnaire;

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
}
