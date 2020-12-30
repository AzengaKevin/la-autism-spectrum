@extends('layouts.front')

@section('content')
<div class="container mx-auto py-4">
    <h2 class="text-2xl font-bold text-center sm:text-left">Questionnaires</h2>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
        @foreach ($questionnaires as $questionnaire)
            <a href="{{ route('questionnaires.show', $questionnaire) }}" class="bg-gray-100 shadow-sm p-4 hover:bg-gray-300 rounded">
                <h3 class="text-gray-600 font-bold text-xl">{{ $questionnaire->title }}</h3>
                <p class="mt-4 text-gray-400">{{ $questionnaire->description }}</p>

                <div class="flex justify-between mt-4 text-gray-500 text-sm">
                    <span class="space-x-1">
                        <span class="font-bold">{{ $questionnaire->questions->count() }}</span>
                        <span>Questions</span>
                    </span>
                    <span class="space-x-1">
                        <span>Minimum Age</span>
                        <span class="font-bold">{{ $questionnaire->min_age }}</span>
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection