@component('mail::message')
# Dear - BD Company

@component('mail::panel')
This is Offer For My All Subscribers
This is Offer For My All Subscribers
This is Offer For My All Subscribers
@endcomponent

@component('mail::button', ['url' => 'www.faceboook.com'])
Jiku
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
