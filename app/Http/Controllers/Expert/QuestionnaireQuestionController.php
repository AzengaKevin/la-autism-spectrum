<?php

namespace App\Http\Controllers\Expert;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Http\Controllers\Controller;

class QuestionnaireQuestionController extends Controller
{

    /**
     * Browsing all the questions of a questionnaire
     */
    public function index(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions');

        return view('expert.questions.index', compact('questionnaire'));
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

    /**
     * Show the create question for a questionnaire page
     */
    public function create(Questionnaire $questionnaire)
    {
        return view('expert.questions.create', compact('questionnaire'));
        
    }

    public function show(Questionnaire $questionnaire, Question $question)
    {

    }

    public function update(Questionnaire $questionnaire, Question $question)
    {
        
    }

    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        
    }

    public function edit(Questionnaire $questionnaire, Question $question)
    {
        
    }

}
