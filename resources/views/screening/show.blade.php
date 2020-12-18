@extends('layouts.front')

@section('content')
<div class="container mx-auto py-4">
    <h2 class="text-2xl text-center sm:text-left font-bold">{{ $questionnaire->title }}</h2>

    <form class="mt-6 divide-y divide-gray-100">
        @foreach ($questionnaire->questions as $question)
        <div class="py-4 px-3 sm:px-0">
            <label class="space-x-1" for="question{{ $question->id }}">
                <span class="font-bold">{{ $loop->iteration }}.</span>
                <span class="font-semibold text-xl">{{ $question->question }}</span>
            </label>

            <input type="hidden" name="responses[{{ $loop->iteration }}][question_id]">

            <fieldset id="question{{ $question->id }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 space-y-3 p-3">
                @foreach ($question->answers as $answer)
                <label for="answer-{{ $answer->id }}">
                    <div class="flex items-center h-5 space-x-2">
                        <input id="answer-{{ $answer->id }}" name="responses[{{ $loop->parent->iteration }}][answer_id]" type="radio" value="{{ $answer->id }}"
                            class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            <span>{{ $answer->answer }}</span>
                    </div>
                </label>
                @endforeach
            </fieldset>

        </div>
        @endforeach

        <div class="flex justify-end py-6 px-3 sm:px-0">
            <x-jet-button>Complete Screening</x-jet-button>
        </div>
    </form>
</div>
@endsection