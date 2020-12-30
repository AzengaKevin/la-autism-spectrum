<div class="p-6 bg-white border-b border-gray-200">

    <div class="flex items-center justify-end py-2">
        <x-jet-button wire:click="$toggle('showUpsertModal')" type="button">Create Questionnaire</x-jet-button>
    </div>

    {{-- Questionnaires Table --}}

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 sm:px-6 lg:px-8 align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table-auto divide-y divide-gray-600 w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th
                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                    ID
                                </th>
                                <th
                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                    Title
                                </th>
                                <th
                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                    Link
                                </th>
                                <th
                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                    Type
                                </th>
                                <th
                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                    Age
                                </th>
                                <th
                                    class="px-3 py-2 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @if ($questionnaires->count())
                            @foreach ($questionnaires as $index => $questionnaire)
                            <tr>
                                <td class="px-3 py-2">{{ $index + 1 }}</td>
                                <td class="px-3 py-2">{{ $questionnaire->title }}</td>
                                <td class="px-3 py-2">
                                    @if ($questionnaire->type === 'questions')
                                    <a class=" text-indigo-500 hover:text-indigo-900"
                                        href="{{ route('expert.questionnaires.questions.index', $questionnaire) }}">{{ $questionnaire->slug }}</a>
                                    @endif

                                    @if ($questionnaire->type === 'pictures')
                                    <a class=" text-indigo-500 hover:text-indigo-900"
                                        href="{{ route('expert.questionnaires.pictures.index', $questionnaire) }}">{{ $questionnaire->slug }}</a>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ $questionnaire->type }}</td>
                                <td class="px-3 py-2">{{ $questionnaire->age }}</td>
                                <td class="px-3 py-2 text-center inline-flex w-full justify-around space-x-2">
                                    <x-jet-secondary-button type="button"
                                        wire:click.prevent="showEditQuestionnaireModal({{ $questionnaire }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </x-jet-secondary-button>
                                    <x-jet-secondary-button type="button"
                                        wire:click.prevent="showConfirmQuestionnaireDeletionModal({{ $questionnaire }})">
                                        <svg class="fill-current text-red-700" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </x-jet-secondary-button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="px-3 py-2" colspan="5">You have no questionnaires created yet...</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Insert or Update questionnaire Modal -->
    <x-jet-dialog-modal wire:model="showUpsertModal">
        <x-slot name="title">
            <span
                class=" font-semibold">{{ __( is_null($questionnaireId) ? 'Create New Questionnaire' : 'Update ' . $questionnaireTitle) }}</span>
        </x-slot>

        <x-slot name="content">

            @if (is_null($questionnaireId))
            <div>The questions and answers are added after adding the questionnaire</div>
            @endif

            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.300ms="title" />
                <x-jet-input-error for="title" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <x-jet-input id="slug" class="block mt-1 w-full" type="text" wire:model="slug" />
                <x-jet-input-error for="slug" class="mt-2" />
            </div>

            <div class="flex flex-col sm:flex-row space-x-2">
                <div class="mt-4 w-full sm:w-1/2">
                    <x-jet-label for="age" value="{{ __('Age Bound') }}" />
                    <x-jet-input id="age" class="block mt-1 w-full" type="text" wire:model="age" />
                    <x-jet-input-error for="age" class="mt-2" />
                </div>

                <div class="mt-4 w-full sm:w-1/2">
                    <x-jet-label for="type" value="{{ __('Questionnaire Type') }}" />
                    <select id="type" autocomplete="type" wire:model="type"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Choose...</option>
                        @foreach (\App\Models\Questionnaire::types() as $t)
                        <option value="{{ $t }}">{{ Str::title($t) }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="type" class="mt-2" />
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <div class="mt-1 ">
                    <textarea id="description" rows="3" class="form-input rounded-md shadow-sm block mt-1 w-full"
                        wire:model.debounce.36000ms="description">
                  </textarea>
                </div>
                <x-jet-input-error for="description" class="mt-2" />
                <p class="mt-2 text-sm text-gray-500">
                    Brief description for your profile. URLs are hyperlinked.
                </p>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showUpsertModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            @if (is_null($questionnaireId))
            <x-jet-button class="ml-2" wire:click="createQuestionnaire" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-jet-button>
            @else
            <x-jet-button class="ml-2" wire:click="updateQuestionnaire" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Delete Questionnaire Modal --}}

    <x-jet-dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Delete A Questionnaire') }}
        </x-slot>

        <x-slot name="content">
            {!! __('Are you sure you want to delete your the questionnaire, <b>' . $questionnaireTitle .'</b>? The
            Questionnaire will be archived for a month after which it will permanently be removed from the database.')
            !!}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteQuestionnaire" wire:loading.attr="disabled">
                {{ __('Delete Questionnaire') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>