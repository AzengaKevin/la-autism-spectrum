@props(['screening'])

<div>
    @foreach ($screening->screeningVideos as $screeningVideo)
    <div class="mt-3 p-3 flex flex-col sm:flex-row space-x-3">
        <div class="text-gray-700 w-full sm:w-1/2">
            <img class="w-full" src="{{ $screeningVideo->picture->pathUrl() }}" alt="{{ $screeningVideo->picture->url }}">
        </div>
        <div class="text-gray-500  w-full sm:w-1/2 mt-2">
            <video class="w-full object-fill" src="{{ $screeningVideo->pathUrl() }}" controls></video>
        </div>
    </div>
    <hr>
    @endforeach
</div>