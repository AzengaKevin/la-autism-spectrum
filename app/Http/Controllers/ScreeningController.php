<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class ScreeningController extends Controller
{
    public function index()
    {
        $questionnaires = Questionnaire::all();
        return view('screening.index', compact('questionnaires'));
    }

    public function show(Questionnaire $questionnaire)
    {
        
        $questionnaire->load('questions.answers');

        return view('screening.show', compact('questionnaire'));
        
    }
}
