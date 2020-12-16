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
                                    Description
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
                                <td class="px-3 py-2"><a class=" text-indigo-500 hover:text-indigo-900"
                                        href="#">{{ $questionnaire->slug }}</a></td>
                                <td class="px-3 py-2">{{ $questionnaire->description }}</td>
                                <td class="px-3 py-2 text-center">
                                    <x-jet-button type="button"
                                        wire:click.prevent="showEditQuestionnaireModal({{ $questionnaire }})">
                                        Edit
                                    </x-jet-button>
                                    <x-jet-danger-button type="button"
                                        wire:click.prevent="showConfirmQuestionnaireDeletionModal({{ $questionnaire }})">
                                        Delete
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                            @endforeach
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

            <div class="mt-4">
                <x-jet-label for="min_age" value="{{ __('Minimum Age') }}" />
                <x-jet-input id="min_age" class="block mt-1 w-full" type="number" wire:model="min_age" />
                <x-jet-input-error for="min_age" class="mt-2" />
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
</div>