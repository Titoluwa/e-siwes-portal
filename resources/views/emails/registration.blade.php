@component('mail::message')
# Welcome to OAU e-SIWES portal

Please verify that your email <b>{{$user->email}}</b> was used to register <b>{{$user->name()}}</b> into this portal.
<p>The token for verification is <b>{{$token}}</b> </p>
<p>Go to <a href="http://localhost:8000/verification" target="_blank">Verify Email</a></p>


{{-- @component('mail::button', ['url' => '/user/verification/'])
Verify email
@endcomponent --}}

Thanks,<br>
OAU, e-SIWES portal
{{-- {{ config('app.name') }} --}}
@endcomponent
