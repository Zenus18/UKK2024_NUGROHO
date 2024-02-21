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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-error">
                        {{session('error')}}
                    </div>
                @endif


                @if(count($errors)> 0)
                    <div class="alert alert-error">
                        <ul  class="p-2">
                            @foreach ($errors->all() as $e)
                                <li>
                                   {{ $e}} 
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <style>
            ::-webkit-scrollbar{
                display: none;
            }
        </style>
    </body>
</html>
