<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QAAP</title>

    @vite('resources/css/app.css')
</head>
<body>
    <h1>Welcome</h1>
    <a href="/tasks" class="btn">tasks</a>
</body>
</html>