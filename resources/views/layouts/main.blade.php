<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
<body class="font-sans bg-gray-900 text-white">
<nav class="border-b border-gray-800">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-center px-4 py-6">
        <ul class="flex flex-col md:flex-row items-center">
            <li class="font-semibold">
                <a href="{{ route('movies.index') }}" class="uppercase">
                    {{ config('app.name') }}
                </a>
            </li>
        </ul>
    </div>
</nav>
@yield('content')
<footer class="border border-t border-gray-800">
    <div class="container mx-auto text-sm px-4 py-6">
        <b>Orazgylyjow Didar</b> tarapyndan ýasaldy
    </div>
</footer>
@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
