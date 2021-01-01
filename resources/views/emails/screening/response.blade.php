@component('mail::message')
# Thank you for taking our questionnaire {{ $screening->name }}

{{ $content }}.

Thanks once more,<br>
{{ config('app.name') }}
@endcomponent
