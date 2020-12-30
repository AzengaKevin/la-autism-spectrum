<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionController extends Controller
{
    public function index(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers');

        return view('expert.questions.index', compact('questionnaire'));
    }

    /**
     * Show the view to create a question for the created questions
     */
    public function create(Questionnaire $questionnaire)
    {
        return view('expert.questions.create', compact('questionnaire'));
    }


    public function store(Request $request, Questionnaire $questionnaire)
    {

        $data = $request->validate([
            'question.question' => ['bail', 'required', 'string', 'max:255'],
            'answers' => ['bail', 'nullable', 'array', 'between:2,4'],
            'answers.*.answer' => ['bail', 'required', 'max:255']
        ]);
        
        //Persist the question
        $question = $questionnaire->questions()->create($data['question']);

        //Persist the Answers
        $question->answers()->createMany($data['answers']);

        return redirect()->route('expert.questionnaires.questions.index', $questionnaire);
    }

}
