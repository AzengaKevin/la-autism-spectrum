@props(['screening'])

<div>
    @foreach ($screening->responses as $response)
    <div class="mt-3 p-3">
        <div class="text-gray-700">{{ $response->question->question }}</div>
        <div class="text-gray-500 mt-2">{{ $response->answer->answer }}</div>
    </div>
    <hr>
    @endforeach
</div>