@component('mail::message')
# Change Password

Please use this token to confirm your request to change the password to your email <b>({{$user->email}})</b> that was used to register <b>{{$user->name()}}</b> into the portal.
<p>The token for confirmation is <b>{{$token}}</b> </p>
<p>Go to <a href="http://localhost:8000/password/reseting" target="_blank">Reset Password</a></p>


{{-- @component('mail::button', ['url' => '/user/verification/'])
Verify email
@endcomponent --}}

Thanks,<br>
OAU, e-SIWES portal
{{-- {{ config('app.name') }} --}}
@endcomponent
