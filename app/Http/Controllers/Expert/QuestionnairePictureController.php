<?php

namespace App\Http\Controllers\Expert;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Http\Controllers\Controller;

class QuestionnairePictureController extends Controller
{
    /**
     * Browsing all the pictures of a questionnaire
     */
    public function index(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions');

        return view('expert.pictures.index', compact('questionnaire'));
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        
    }
    
}
