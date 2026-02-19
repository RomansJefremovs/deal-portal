@component('mail::message')
# Welcome!

Your account has been created.

**Email:** {{ $user->email }}
**Password:** {{ $password }}

Please log in and change your password.

@component('mail::button', ['url' => url('/login')])
Login
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
