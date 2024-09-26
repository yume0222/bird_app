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
        {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
        <link rel="stylesheet" href="{{ asset('/css/app/style.css') }}">
    </head>
   <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- sp --><!-- Page Content -->
            <div class="sp_app_container">
                <div>
                    {{ $slot }}
                </div>
                <!--<x-post-button class="button"/>-->
                <div class="sp_footer">
                    @include('layouts.navigation')
                </div>
            </div>
            
            <!-- pc --><!-- Page Content -->
            <div class="pc_app_container" >
                <div class="pc_footer">
                    @include('layouts.navigation')
                </div>
                <div class="pc_body">
                    {{ $slot }}
                </div>
                <div class="pc_button">
                    <x-post-button />
                </div>
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
        </div>
</html>
