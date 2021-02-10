@component('mail::message')
# Please activate your account

@component('mail::panel')
To activate your account
@endcomponent

@component('mail::button', ['url' => $url])
Click here
@endcomponent

Thanks,<br>
Blue Book Store Team @2021
@endcomponent
