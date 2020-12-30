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
                        <x-button-link href="{{ route('expert.questionnaires.questions.create', $questionnaire) }}" class="">Add A Question</x-button-link>
                    </div>
                    <livewire:questions :questionnaire="$questionnaire" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
