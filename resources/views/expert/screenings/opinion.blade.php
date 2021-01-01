<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($screening->questionnaire->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('expert.screenings.opinion.send', $screening) }}" method="post">
                        @csrf
                        <div class="mt-4">
                            <x-jet-label for="content" value="{{ __('Description') }}" />
                            <div class="mt-1 ">
                                <textarea id="content" name="content" rows="5"
                                    class="form-input rounded-md shadow-sm block mt-1 w-full">
                              </textarea>
                            </div>
                            <x-jet-input-error for="content" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-jet-button>Submit</x-jet-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>