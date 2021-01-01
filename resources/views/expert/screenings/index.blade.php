<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Screenings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

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
                                                    Questionnaires
                                                </th>
                                                <th
                                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                                    Respondent Name
                                                </th>
                                                <th
                                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                                    Respondent Email
                                                </th>
                                                <th
                                                    class="px-3 py-2 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                                    Response Date
                                                </th>
                                                <th
                                                    class="px-3 py-2 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="bg-white divide-y divide-gray-200">

                                            @if ($screenings->count())
                                            @foreach ($screenings as $index => $screening)
                                            <tr>
                                                <td class="px-3 py-2">{{ $index + 1 }}</td>
                                                <td class="px-3 py-2">{{ $screening->questionnaire->title }}</td>
                                                <td class="px-3 py-2">{{ $screening->name }}</td>
                                                <td class="px-3 py-2">{{ $screening->email }}</td>
                                                <td class="px-3 py-2">{{ $screening->created_at->format('Y-m-d') }}</td>
                                                <td
                                                    class="px-3 py-2 text-center inline-flex w-full justify-around space-x-2">
                                                    <x-button-link
                                                        href="{{ route('expert.screenings.show', $screening) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                    </x-button-link>

                                                    <form class="inline-block"
                                                        action="{{ route('expert.screenings.destroy', $screening) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-jet-secondary-button>
                                                            <svg class="fill-current text-red-700"
                                                                xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg>
                                                        </x-jet-secondary-button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td class="px-3 py-2" colspan="5">You have no screenings created
                                                    yet...</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>