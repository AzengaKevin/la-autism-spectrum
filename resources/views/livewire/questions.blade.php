<div>
    <!-- Display the question and answers in the questionnaire -->
    <div class="bg-white divide-y divide-gray-300">
        @foreach ($questionnaire->questions as $question)
        <div class="py-3">
            <div class="flex flex-col md:flex-row justify-between">
                <h4 class="font-bold text-gray-600">{{ $question->question }}</h4>
                <span class="px-2 py-1 mt-3 md:mt-0 text-sm rounded-full bg-blue-200">{{ $question->answers->count() }} Answers</span>
            </div>
    
            <div class="mt-3">
                <h5 class="text-sm font-semibold text-gray-500">Answers</h5>
                <div class="grid gap-6 grid-cols-2 mt-2">
                    @foreach ($question->answers as $answer)
                    <div>{{ $answer->answer }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
