<x-custom-form-section action="{{ route('expert.questionnaires.questions.store', $questionnaire) }}">
    <x-slot name="title">
        {{ __('Create A Question with Answers') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create the question with appropriate answers, you must have multiple answers for it to make sense. The answers should be between 2 and 4 in count') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="font-semibold" for="question" value="{{ __('Question') }}" />
            <x-jet-input id="question" type="text" class="mt-1 block w-full" name="question[question]"
                value="{{ old('question.question') }}" />
            <x-jet-input-error for="question.question" class="mt-2" />
        </div>

        <fieldset class="col-span-6 border border-gray-300 rounded">
            <legend class=" font-semibold text-gray-600">Answers</legend>

            @error('answers')
            <div class="my-2 px-6">
                <x-jet-input-error for="answers" />
            </div>
            @enderror

            @foreach ($answers as $i => $answer)
            <div class="px-6 pt-4">
                <div class="flex items-center space-x-4">
                    <div class="flex-1">
                        <x-jet-input id="answer-{{ $i + 1 }}" type="text" class="mt-1 block w-full"
                            name="answers[{{ $i }}][answer]" value="{{ old('answers.' . $i . '.answer') }}"
                            wire:model.lazy="answers.{{ $i }}" placeholder="Option {{ $i + 1 }}" />
                        <x-jet-input-error for="answers.{{ $i }}.answer" class="mt-2" />
                    </div>
                    <div>
                        <button type="button" class="text-red-500 focus:outline-none"
                            wire:click.prevent="deleteAnswerField({{ $i }})">Remove</button>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="px-6 py-4">
                <x-jet-button type="button" wire:click.prevent="addAnswerField">Add Answer</x-jet-button>
            </div>
        </fieldset>

    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-custom-form-section>