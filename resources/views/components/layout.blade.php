<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QAAP</title>

    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <nav>
            <h1>Task layout</h1>
            <a href="/tasks">All tasks</a>
            <a href="/tasks/create">Create new task</a>
        </nav>
    </header>

    <main class="container">
        {{ $slot }}
    </main>
</body>
</html>