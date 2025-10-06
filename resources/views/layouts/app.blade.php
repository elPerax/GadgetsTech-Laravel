<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sam & Shawn CandyShop') }}</title>

    <!-- 🍭 Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- 🍬 Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #ffe6f0;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            color: #ff4d6d;
        }

        header {
            background: white;
            border-bottom: 5px solid #ff4d6d;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen">

        <!-- 🍬 Navigation -->
        @include('layouts.navigation')

        <!-- 🍭 Page Heading -->
        @hasSection('header')
            <header>
                <div class="container">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- 🍡 Page Content -->
        <main class="container">
            @yield('content')
        </main>
    </div>
</body>
</html>
