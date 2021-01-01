@props(['screening'])

<div class="w-full">
    @if (!is_null($screening->path))
    <video src="{{ $screening->pathUrl() }}" controls></video>
    @endif
</div>