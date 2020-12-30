<div>

    <!-- Display the pictures in the questionnaire -->
    <div class="">
        <div class="flex items-center justify-end py-2">
            <x-jet-button wire:click="$toggle('showUpsertModal')" type="button">Add Picture</x-jet-button>
        </div>
    </div>

    <!-- Insert or Update Picture Modal -->
    <x-jet-dialog-modal wire:model="showUpsertModal">
        <x-slot name="title">
            <span class=" font-semibold">{{ __('Add New Picture') }}</span>
        </x-slot>

        <x-slot name="content">

            <div class="mt-4">
                <x-jet-label for="alt" value="{{ __('Description') }}" />
                <x-jet-input id="alt" class="block mt-1 w-full" type="text" wire:model.debounce.300ms="alt" />
                <x-jet-input-error for="alt" class="mt-2" />
            </div>


            <div x-data="{photoName: null, photoPreview: null}" class="mt-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="picture" x-ref="picture" />
                <x-jet-label for="picture" value="{{ __('Picture') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2">
                    <img src="{{ is_null($picture) ? url('/img/placeholder.png') : $picture->temporaryUrl() }}" alt="{{ $alt }}"
                        class="h-auto w-64 object-cover border border-gray-200">
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.picture.click()">
                    {{ __('Select A Picture') }}
                </x-jet-secondary-button>

                <x-jet-input-error for="picture" class="mt-2" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showUpsertModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            @if (is_null($pictureId))
            <x-jet-button class="ml-2" wire:click="createPicture" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-jet-button>
            @else
            <x-jet-button class="ml-2" wire:click="updateQuestionnaire" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Questionnaire Modal -->
    <x-jet-dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Delete A Picture') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('Are you sure you want to delete your the picture below?') }}
            </div>
            <div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showDeleteModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteQuestionnaire" wire:loading.attr="disabled">
                {{ __('Delete Picture') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>