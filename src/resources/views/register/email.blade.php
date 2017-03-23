@component('mail::message')
# Welcome to Wolf

Thank you for registering to access toy account click the button below.

@component('mail::button', ['url' => route('home')])
Enter Wolf
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
