@component('mail::message')
# Hello, {{ $user->name }}!

You have new feedback from {{ $feedback->user->name }} on site.

@component('mail::button', ['url' => '/'])
Review feedback
@endcomponent

@component('mail::table')
| | |
| ------------- |:-------------:|
| Subject | {{ $feedback->subject }} |
| Message | {{ $feedback->message }} |
| Created At | {{ $feedback->created_at }} |
@endcomponent

@endcomponent
