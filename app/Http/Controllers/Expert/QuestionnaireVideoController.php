<?php

namespace App\Http\Controllers\Expert;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Http\Controllers\Controller;

class QuestionnaireVideoController extends Controller
{

    /**
     * Browsing all the questions of a questionnaire
     */
    public function index(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions');

        return view('expert.videos.index', compact('questionnaire'));
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        
        $data = $request->validate([
            'description' => ['bail', 'required', 'string', 'max:255'],
            'video' => ['bail', 'required', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4', 'max:40960']
        ]);

        //Store the video
        $path = $data['video']->store('questionnaire/pictures', 'public');

        $data['path'] = $path;

        //Persist the video details
        $questionnaire->video()->create($data);
        
        return redirect()->route('expert.questionnaires.videos.index', $questionnaire);

    }

    /**
     * Show the create question for a questionnaire page
     */
    public function create(Questionnaire $questionnaire)
    {
        return view('expert.videos.create', compact('questionnaire'));
        
    }


    /**
     * Updating a questionnaire video
     */
    public function update(Request $request, Questionnaire $questionnaire, Video $video)
    {
        
        $data = $request->validate([
            'description' => ['bail', 'required', 'string', 'max:255'],
            'video' => ['nullable', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4', 'max:40960']
        ]);

        if(isset($data['video'])){

            $video->deleteFileFromStorageIfNecessary();

            //Store the video
            $path = $data['video']->store('questionnaire/pictures', 'public');

            $data['path'] = $path;
        }

        //Persist the video details
        $video->update($data);
        
        return redirect()->route('expert.questionnaires.videos.index', $questionnaire);
        
    }

    public function destroy(Questionnaire $questionnaire, Video $video)
    {
        
    }

    public function edit(Questionnaire $questionnaire, Video $video)
    {
        return view('expert.videos.edit', compact('questionnaire', 'video'));
        
    }
}
