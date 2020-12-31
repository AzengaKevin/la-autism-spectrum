@extends('layouts.front')

@section('content')
<div class="container mx-auto py-4">
    <h2 class="text-2xl text-center sm:text-left font-bold">{{ $questionnaire->title }}</h2>

    <form action="{{ route('questionnaires.screenings.store', $questionnaire) }}" enctype="multipart/form-data"
        class="mt-6 divide-y divide-gray-100" method="POST">
        @csrf

        <div>
            @if (!is_null($questionnaire->video))
            <video controls>
                <source src="{{ $questionnaire->video->pathUrl() }}" type="">
                {{ $questionnaire->video->description }}
            </video>
            @endif
        </div>

        <div>
            <div class="mt-4">
                <x-jet-label class="space-x-1" for="video" value="Upload video for the video" />
                <input class="block mt-2" type="file" name="video" id="video">
                <x-jet-input-error for="video" />
            </div>
        </div>

        <hr class="my-4">

        <fieldset class="border border-gray-400">
            <legend>Respondent</legend>

            <div class="flex flex-col sm:flex-row sm:space-x-3 px-3 pb-6">
                <div class="mt-4 w-full sm:w-1/2">
                    <x-jet-label for="respondentName" value="{{ __('Name') }}" />
                    <x-jet-input class="block mt-1 w-full" id="respondentName" type="text" name="respondent[name]"
                        value="{{ old('respondent.name') ?? Auth::check() ? Auth::user()->name : '' }}" />
                </div>

                <div class="mt-4 w-full sm:w-1/2">
                    <x-jet-label for="respondentEmail" value="{{ __('Email Address') }}" />
                    <x-jet-input class="block mt-1 w-full" id="respondentName" type="text" name="respondent[email]"
                        value="{{ old('respondent.email') ?? Auth::check() ? Auth::user()->email : '' }}" />
                </div>
            </div>

        </fieldset>
        <div class="flex justify-end py-6 px-3 sm:px-0">
            <x-jet-button>Complete Screening</x-jet-button>
        </div>

    </form>
</div>
@endsection