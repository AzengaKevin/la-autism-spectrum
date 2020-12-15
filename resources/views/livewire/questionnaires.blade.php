<div class="p-6 bg-white border-b border-gray-200">

    <div class="flex items-center justify-end">
        <x-jet-button wire:click="$toggle('showUpsertModal')" type="button">Create Questionnaire</x-jet-button>
    </div>

    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="showUpsertModal">
        <x-slot name="title">
            <span class=" font-semibold">{{ __('Create New Questionnaire') }}</span>
        </x-slot>

        <x-slot name="content">

            <div>The questions and answers are added after adding the questionnaire</div>

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

            <x-jet-button class="ml-2" wire:click="addQuestionnaire" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>