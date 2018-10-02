<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Account</title>
</head>
<body>
    {{{ Auth::user()->email }}} <br>
    {{{ Auth::user()->name }}} <br>
    {{{ Auth::user()->level }}} <br>
    {{{ Auth::user()->money_1 }}}

</body>
</html>