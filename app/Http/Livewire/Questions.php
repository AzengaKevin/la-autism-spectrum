<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Questions extends Component
{
    public $questionnaire;
    
    public function render()
    {
        return view('livewire.questions');
    }
}
