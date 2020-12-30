<div>

    <!-- Display the pictures in the questionnaire -->
    <div class="">
        <div class="flex items-center justify-end py-2">
            <x-jet-button wire:click="$toggle('showUpsertModal')" type="button">Add Picture</x-jet-button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

            @foreach ($pictures as $p)
            <div class="relative">
                <img class="w-full" src="{{ $p->thumbnailUrl() }}" alt="{{ $p->alt }}">

                <div class="absolute bottom-0 inset-x-0 bg-transparent px-3 py-2 flex justify-end space-x-2">
                    <a target="_blank" href="{{ $p->pathUrl() }}">
                        <svg class="fill-current h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg>
                    </a>

                    <button class="outline-none focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg"  class="fill-current h-6 w-6 text-red-500" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                          </svg>
                    </button>
                </div>
            </div>
            @endforeach
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
                    <img src="{{ is_null($picture) ? url('/img/placeholder.png') : $picture->temporaryUrl() }}"
                        alt="{{ $alt }}" class="h-auto w-64 object-cover border border-gray-200">
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