<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<h4>Hello {{ $email }} </h4>
<p>
    This is to notify you that have been invited to become an admin in Industrialising Africa. Please click the link below to complete registration.
    <a href="{{ $link }}">Click Here</a>
    <br>
    or
    <br>
    You can copy and paste this link in your browser tab. {{ $link }}
</p>
<p>
    Kindest regards,<br>
    <span style="font-style: italic;">Industrialising Africa</span><br>
</p>

<img src="{{ asset('site_images/ialogo.png') }}" alt="">
</body>
</html>
