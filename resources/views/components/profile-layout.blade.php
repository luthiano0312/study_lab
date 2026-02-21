<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/favicons/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicons/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ asset('assets/favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons/apple-touch-icon.png') }}" />
        <meta name="apple-mobile-web-app-title" content="Nitros" />
        <link rel="manifest" href="{{ asset('assets/favicons/site.webmanifest') }}" />
        <title>Nitros</title>

    
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('assets/css/games.css')}}" />

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="m-0 bg-gray-800 min-h-screen text-white">
        <div class="min-h-screen bg-gray-900">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-[#070707] border-b-2   border-primary">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="bg-[#070707]">
                {{ $slot }}
            </main>
        </div>
    </body>

</html>
