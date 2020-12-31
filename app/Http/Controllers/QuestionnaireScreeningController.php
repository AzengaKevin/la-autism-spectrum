<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Validation\Rule;

class QuestionnaireScreeningController extends Controller
{
    public function store(Request $request, Questionnaire $questionnaire)
    {
        $data = $request->validate([
            'responses' => ['bail', Rule::requiredIf($questionnaire->type !== 'video'), 'array', 'min:1'],
            'responses.*.question_id' => ['bail', Rule::requiredIf($questionnaire->type === 'questions'), 'numeric'],
            'responses.*.answer_id' => ['bail', Rule::requiredIf($questionnaire->type === 'questions'), 'numeric'],
            'responses.*.picture_id' => ['bail', Rule::requiredIf($questionnaire->type === 'pictures'), 'numeric'],
            'responses.*.video' => ['bail', Rule::requiredIf($questionnaire->type === 'pictures'), 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,application/x-mpegURL,video/MP2T'],
            'video' => ['bail', Rule::requiredIf($questionnaire->type === 'video'), 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,application/x-mpegURL,video/MP2T'],
            'respondent' => ['bail', 'array'],
            'respondent.name' => ['required'],
            'respondent.email' => ['required'],
        ]);

        //dd($data);

        $screeningData = [];

        if(isset($data['respondent'])){
            $screeningData['name'] = $data['respondent']['name'];
            $screeningData['email'] = $data['respondent']['email'];
        }else{
            if(Auth::check()){
                $screeningData['user_id'] = Auth::id();
            }
        }

        //Upload the response video for video questionnaire
        if($questionnaire->type === 'video'){
            $path = $data['video']->store('questionnaire/video', 'public');
            $screeningData['path'] = $path;
        }

        $screening = $questionnaire->screenings()->create($screeningData);

        //Persist the questions and answers
        if($questionnaire->type === 'questions'){
            $screening->responses()->createMany($data['responses']);
        }

        //Upload and persist videos for picture questionnaire
        if($questionnaire->type === 'pictures'){
            foreach($data['responses'] as $response){
                $path = $response['video']->store('questionnaire/video', 'public');
                $response['path'] = $path;
    
                $screening->screeningVideos()->create($response);
            }
        }

        //Set success message to the session
        $request->session()->flash('success_message', 'Congradulations ! Response Submitted Successfully, you will recieve results in your mail');

        return redirect()->route('questionnaires.index');
    }
}
