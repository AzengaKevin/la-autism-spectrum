<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnairePictureController extends Controller
{
    public function index(Questionnaire $questionnaire )
    {
        $questionnaire->load('pictures');

        return view('pictures.index', compact('questionnaire'));
    }
}
