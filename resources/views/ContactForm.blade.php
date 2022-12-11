@component('mail::message')
    Thank you for sending a message to our team, expect a response within 24 to 48 hours <br><br>
    Name: {{$name}} <br>
    Email: {{$email}}<br>
    Subject: {{$subject}}<br>
    Message: {{$messageText}}<br>
@endcomponent