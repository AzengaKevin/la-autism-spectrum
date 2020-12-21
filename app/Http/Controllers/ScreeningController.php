<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;

class ScreeningController extends Controller
{
    /**
     * Show all the questionnaires for screening
     */
    public function index()
    {
        $questionnaires = Questionnaire::all();
        return view('screening.index', compact('questionnaires'));
    }

    /**
     * Shows a single questionnaire and a from for taking the questionnaire
     */
    public function show(Questionnaire $questionnaire)
    {
        
        $questionnaire->load('questions.answers');

        return view('screening.show', compact('questionnaire'));
        
    }

    /**
     * Stores a user response to the database
     */
    public function store(Request $request, Questionnaire $questionnaire)
    {
        $data = $request->validate([
            'responses' => ['bail', 'required', 'array', 'min:1'],
            'responses.*.question_id' => ['bail', 'required', 'numeric'],
            'responses.*.answer_id' => ['bail', 'required', 'numeric'],
            'respondant' => ['bail', 'array'],
        ]);
        
        $screeningData = [];

        if(isset($data['respondant'])){
            $screeningData['name'] = $data['respondant']['name'];
            $screeningData['email'] = $data['respondant']['email'];
        }else{
            if(Auth::check()){
                $screeningData['user_id'] = Auth::id();
            }
        }

        $screening = $questionnaire->screenings()->create($screeningData);

        $screening->responses()->createMany($data['responses']);

        return redirect()->route('screenings.index');

    }
}
