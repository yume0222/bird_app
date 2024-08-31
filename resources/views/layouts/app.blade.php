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
  <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .app_container {
            display: flex;
        }
        .footer {
           
        }
        .body {
            width: calc(100% - 64px);
            max-width: 675px;
            height: calc(100vh - 64px);
            margin: 32px auto;
            border: 1px solid #000000;
            overflow: scroll;
            scrollbar-width: none;
        }
        .button {
         
        }
        </style>
        
   
        
        </style>
    </head>
   <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <div class="app_container">
                <div class="footer">@include('layouts.navigation')</div>
                     <div class="body">
                          {{ $slot }}
                     </div>
                <div class="button"><x-post-button /></div>
            </div>
            <!-- Page Content -->

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            
            <!--<x-post-button />-->
        </div>
</html>
