<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnaireQuestionController extends Controller
{
    public function index(Questionnaire $questionnaire )
    {
        $questionnaire->load('questions');

        return view('questions.index', compact('questionnaire'));
    }
}
