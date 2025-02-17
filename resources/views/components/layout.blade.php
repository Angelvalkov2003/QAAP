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
    @if (@session('error'))
    <div id="flash" class="p04 text-center bg-red-50 text-red-500 font-bold">
        {{ session('error') }}
    </div>
    @endif

    <header>
        <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 ">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 flex items-center justify-between">
                <a href="{{ route('tasks.index')}}" class="flex items-center space-x-3 rtl:space-x-reverse md:-mt-2">
                    <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white text-blue-600">
                        QA allocation program
                    </span>
                </a>
                <button data-collapse-toggle="navbar-solid-bg" type="button" 
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg 
                md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 
                dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            
            <div class="hidden w-full md:block md:w-auto items-center" id="navbar-solid-bg">
                <ul class="flex flex-col font-medium rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse 
                    md:flex-row md:mt-2 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700 flex items-center">
                    
                    @guest
                    <li>
                        <a href="{{ route('show.login') }}" class="block py-2 px-3 md:p-0 md:text-lg text-gray-900 rounded-sm hover:bg-gray-100 
                        md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 
                        dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('show.register')}}" class="block py-2 px-3 md:p-0 md:text-lg text-gray-900 rounded-sm hover:bg-gray-100 
                        md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 
                        dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                    </li>
                    @endguest
            
                    @auth
                    <li class="flex items-center space-x-2 md:text-lg">
                        <span class="font-semibold">Hi, {{ Auth::user()->name }}</span>
                        <span class="text-gray-400">|</span>
                    </li>
                    <li>
                        <a href="{{ route('tasks.index')}}" class="block py-2 px-3 md:p-0 md:text-lg text-gray-900 rounded-sm hover:bg-gray-100 
                        md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 
                        dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">All tasks</a>
                    </li>
                    <li>
                        <a href="{{ route('tasks.create')}}" class="block py-2 px-3 md:p-0 md:text-lg text-gray-900 rounded-sm hover:bg-gray-100 
                        md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 
                        dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Create new task</a>
                    </li>
                    <li>
                        <a href="{{ route('folders.create') }}" class="block py-2 px-3 md:p-0 md:text-lg text-gray-900 rounded-sm hover:bg-gray-100 
                        md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 
                        dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Create Folder</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="Post" class="m-0">
                            @csrf
                            <button class="block py-2 px-3 md:p-0 md:text-lg text-gray-900 rounded-sm hover:bg-gray-100 
                            md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 
                            dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Logout</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
            
            </div>

        </nav>
    </header>

    <main class="container">
        {{ $slot }}
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuButton = document.querySelector("[data-collapse-toggle]");
            const menu = document.getElementById("navbar-solid-bg");
    
            menuButton.addEventListener("click", function () {
                menu.classList.toggle("hidden");
            });
        });
    </script>
</body>
</html>