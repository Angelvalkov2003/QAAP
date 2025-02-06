<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QAAP</title>

    @vite('resources/css/app.css')
</head>
<body>
    @if (@session('success'))
        <div id="flash" class="p04 text-center bg-green-50 text-green-500 font-bold">
            {{ session('success') }}
        </div>
    @endif

    <header>
        <nav>
            <h1>QA allocation program</h1>
            <a href="{{ route('tasks.index')}}">All tasks</a>
            <a href="{{ route('tasks.create')}}">Create new task</a>

            <a href="{{ route('show.login') }}" class="btn">Login</a>
            <a href="{{ route('show.register')}}" class="btn">Register</a>

        </nav>
    </header>

    <main class="container">
        {{ $slot }}
    </main>
</body>
</html>