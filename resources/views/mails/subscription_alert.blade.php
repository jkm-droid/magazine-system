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
    This is to notify you that Industrialising Africa Publication have received a new subscription from {{ $details['user_name'] }}
</p>
<p>
    Kindest regards,<br>
    <span style="font-style: italic;">Industrialising Africa</span><br>
</p>

<img src="{{ asset('site_images/ialogo.png') }}" alt="">
</body>
</html>
