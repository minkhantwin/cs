Hello {{$email_data['name']}}
<br>
Welcome to Collective Survey
<br>
Please click the below link to verify your email and activate your account.
<br><br>
<a href="{{ env('APP_URL') }}/verify?code={{$email_data['verification_code']}}">Click me</a>
<br>
Thank you

