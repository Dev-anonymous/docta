@component('mail::message')
#  {{ @$data->user?? '' }}

{!! nl2br($data->msg) !!}


{{ config('app.name') }}
@endcomponent
