<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($questionnaire->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-end py-2">

                        @if (is_null($questionnaire->video))
                        <x-button-link href="{{ route('expert.questionnaires.videos.create', $questionnaire) }}" class="">Add The Video</x-button-link>
                        @else
                        <x-button-link href="{{ route('expert.questionnaires.videos.edit', ['questionnaire' => $questionnaire, 'video' => $questionnaire->video]) }}" class="">Edit The Video</x-button-link>
                        @endif
                    </div>
                    
                    @if (!is_null($questionnaire->video))
                    <video controls>
                        <source src="{{ $questionnaire->video->pathUrl() }}" type="">
                        {{ $questionnaire->video->description }}
                    </video>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
