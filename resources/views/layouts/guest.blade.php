<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        <style>
            .container {
                display: flex;
                justify-content: center;
            }
            .border {
                box-shadow: 0 3px 6px #9DC3C0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!--<div>-->
            <!--    <a href="/">-->
            <!--        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />-->
            <!--    </a>-->
            <!--</div>-->

            <div class="border">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
