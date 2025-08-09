<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="bg-light text-dark">
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-4 pt-sm-0" style="background-color: rgb(243 244 246)">


        <div class="">
            <img src="{{ asset('assets/images/female_user.png') }}" alt="Logo" class="img-fluid" style="width: 80px; height: 80px;" />
        </div>

        <div class="w-100" style="max-width: 448px; padding: 1rem; background-color: white; box-shadow: 0 .125rem .25rem rgba(0, 0, 0, 0.075); border-radius: 0.3rem; overflow: hidden;">
            {{ $slot }}
        </div>

    </div>
</body>
</html>
