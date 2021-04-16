<?php
/** @var \App\Forecast $forecast */
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
    <h1>Погода на {{ date('d.m.Y') }}</h1>
    <div>
        <div>Сегодня: {{$forecast->degrees}} <img src="{{$forecast->image}}"/> </div>
    </div>
</body>
</html>

