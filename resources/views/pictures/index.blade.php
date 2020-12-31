@extends('layouts.front')

@section('content')
<div class="container mx-auto py-4">
    <h2 class="text-2xl text-center sm:text-left font-bold">{{ $questionnaire->title }}</h2>

    <form action="{{ route('questionnaires.screenings.store', $questionnaire) }}" enctype="multipart/form-data"
        class="mt-6 divide-y divide-gray-100" method="POST">
        @csrf
        @foreach ($questionnaire->pictures as $picture)
        <div class="py-4 px-3 sm:px-0 flex flex-col sm:flex-row sm:items-center space-x-3">

            <div class="w-full sm:w-1/2">
                <span>Picture {{ $loop->iteration }}.</span>
                <div class="mt-2">
                    <a href="{{ $picture->pathUrl() }}">
                        <img class="sm:w-full" src="{{ $picture->thumbnailUrl() }}" alt="{{ $picture->alt }}">
                    </a>
                </div>
            </div>

            <div class="w-full sm:w-1/2">
                <div class="mt-2">
                    <x-jet-label class="space-x-1" for="picture-{{ $picture->id }}"
                        value="Upload video for picture {{ $loop->iteration }}" />
                    <input class="block mt-2" type="file" name="responses[{{ $loop->iteration }}][video]"
                        id="picture-{{ $picture->id }}">
                    <x-jet-input-error for="responses.{{ $loop->iteration }}.video" />
                </div>

                <input type="hidden" name="responses[{{ $loop->iteration }}][picture_id]" value="{{ $picture->id }}">
            </div>
        </div>
        @endforeach

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