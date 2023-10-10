@component('mail::message')
# Hello !

Please submit the below token to verify your email address.

@component('mail::button', ['url' => ''])
{{ $userData->token }}
@endcomponent

If you did not create an account, no further action is required.<br>
Regards,<br>
{{ config('app.name') }}
@endcomponent