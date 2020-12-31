<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnaireVideoController extends Controller
{
    public function index(Questionnaire $questionnaire )
    {
        $questionnaire->load('video');

        return view('videos.index', compact('questionnaire'));
    }
}
