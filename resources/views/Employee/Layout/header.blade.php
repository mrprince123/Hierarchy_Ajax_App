<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('title')

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    {{-- Tailwind CLI  --}}
    @vite('resources/css/app.css')

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Ajax CDN  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- FlowBite CDN  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <header class="bg-slate-200 p-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <a href="{{ route('employee.home') }}" class="flex gap-2 items-center">
                <i class="fa-solid fa-house-user text-teal-400"></i>
                <h2 class="font-bold text-xl text-teal-400">Chetu Hierarchy</h2>
            </a>
        </div>

        <div class="flex gap-2">
            <a class="bg-teal-500 rounded-lg p-1 font-semibold text-white hover:bg-teal-400 hover:shadow-lg"
                href="{{ '/home' }}"><i class="fa-solid fa-house-user"></i> Home</a>
            <a class="bg-teal-500 rounded-lg p-1 font-semibold text-white hover:bg-teal-400 hover:shadow-lg"
                href="{{ route('auth.employee.hierarchy') }}"><i class="fa-solid fa-sitemap"></i> See
                Hierarchy</a>
            <a class="bg-teal-500 rounded-lg p-1 font-semibold text-white hover:bg-teal-400 hover:shadow-lg"
                href="{{ route('employee.logout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </header>
