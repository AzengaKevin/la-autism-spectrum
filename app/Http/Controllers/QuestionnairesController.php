<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;

class QuestionnairesController extends Controller
{
    /**
     * Show all the questionnaires for questionnaires
     */
    public function index()
    {
        $questionnaires = Questionnaire::all();
        return view('questionnaires.index', compact('questionnaires'));
    }

}
