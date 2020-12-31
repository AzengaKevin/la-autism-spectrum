<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Video for ' . $questionnaire->title) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form action="{{ route('expert.questionnaires.videos.update', [
                'questionnaire' => $questionnaire,
                'video' => $questionnaire->video,
            ]) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <x-jet-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description') ?? $video->description" autofocus />
                    <x-jet-input-error for="description" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="video" value="{{ __('Video') }}" />
                    <div class="mt-2">
                        <input type="file" name="video" id="video">
                    </div>
                    <x-jet-input-error for="video" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-button>Submit</x-jet-button>
                </div>
            </form>
        </div>
    </div>
    
</x-app-layout>