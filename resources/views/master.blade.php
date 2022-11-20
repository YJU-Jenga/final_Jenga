<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ichigo</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js'])
    <!-- Styles -->
    <style>

    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    {{-- @if (Route::has('login')) --}}
    {{--    <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block"> --}}
    {{--        @auth --}}
    {{--            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Dashboard</a> --}}
    {{--        @else --}}
    {{--            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Log in</a> --}}

    {{--            @if (Route::has('register')) --}}
    {{--                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline dark:text-gray-500">Register</a> --}}
    {{--            @endif --}}
    {{--        @endauth --}}
    {{--    </div> --}}
    {{-- @endif --}}
    <div class="flex flex-row px-6 py-4 sm:block">
        <ul class="flex">

            <li>
                <a href="{{ url('/main') }}" class="block pl-3 text-5xl text-amber-400">Title</a>
            </li>
            @auth
                <li>
                    <a href="{{ url('/dashboard') }}"
                        class="text-xl text-gray-700 underline dark:text-gray-500">Dashboard</a>
                </li>
            @else
                <a href="{{ route('login') }}" class="text-xl text-gray-700 underline dark:text-gray-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-xl text-gray-700 underline dark:text-gray-500">Register</a>
                @endif
            @endauth
        </ul>
        {{--    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Dashboard</a> --}}

    </div>

    @yield('content')

</body>

</html>
