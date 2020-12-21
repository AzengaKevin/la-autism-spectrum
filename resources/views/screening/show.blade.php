@extends('layouts.front')

@section('content')
<div class="container mx-auto py-4">
    <h2 class="text-2xl text-center sm:text-left font-bold">{{ $questionnaire->title }}</h2>

    <form action="{{ route('screenings.store', $questionnaire) }}" class="mt-6 divide-y divide-gray-100" method="POST">
        @csrf
        @foreach ($questionnaire->questions as $question)
        <div class="py-4 px-3 sm:px-0">
            <label class="space-x-1" for="question{{ $question->id }}">
                <span class="font-bold">{{ $loop->iteration }}.</span>
                <span class="font-semibold text-xl">{{ $question->question }}</span>
            </label>
            <x-jet-input-error for="responses.{{ $loop->iteration }}.answer_id" />

            <input type="hidden" name="responses[{{ $loop->iteration }}][question_id]" value="{{ $question->id }}">

            <fieldset id="question{{ $question->id }}"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 space-y-3 p-3">
                @foreach ($question->answers as $answer)
                <label for="answer-{{ $answer->id }}">
                    <div class="flex items-center h-5 space-x-2">
                        <input id="answer-{{ $answer->id }}" name="responses[{{ $loop->parent->iteration }}][answer_id]"
                            type="radio" value="{{ $answer->id }}"
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <span>{{ $answer->answer }}</span>
                    </div>
                </label>
                @endforeach
            </fieldset>
        </div>
        @endforeach

        <hr class="my-4">

        <fieldset class="border border-gray-400">
            <legend>Respondent</legend>

            <div class="flex space-x-3 px-3 pb-6">
                <div class="mt-4 w-1/2">
                    <x-jet-label for="respondentName" value="{{ __('Name') }}" />
                    <x-jet-input class="block mt-1 w-full" id="respondentName" type="text" name="respondent[name]" value="{{ old('respondent.name') }}" />
                </div>
    
                <div class="mt-4 w-1/2">
                    <x-jet-label for="respondentEmail" value="{{ __('Email Address') }}" />
                    <x-jet-input class="block mt-1 w-full" id="respondentName" type="text" name="respondent[email]" value="{{ old('respondent.email') }}" />
                </div>
            </div>

        </fieldset>

        <div class="flex justify-end py-6 px-3 sm:px-0">
            <x-jet-button>Complete Screening</x-jet-button>
        </div>
    </form>
</div>
@endsection