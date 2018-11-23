<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

</head>
<body>
<div>
    <form method="post" action="http://localhost/github/laravel56/server.php/user/test">
        {{csrf_field()}}
        <button type="submit">提交</button>
    </form>
</div>
</body>
</html>
