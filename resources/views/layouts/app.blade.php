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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-T305PgEqT9yeAFbh18hhhZKPcpBgBnPJcTPDcjB0C0zM1iZnYf34Rq7DcV4gLq7" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color:#FCF5E5;" class="font-sans antialiased">
    <div class="min-h-screen ">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            @if (isset($slot))
            {{ $slot }}

            @else
            @yield('content')
            @endif

        </main>
    </div>
    <footer class="footer text-center bg-customGreen-500">
        <div class="container-fluid p-3">
            <p class="mb-0 text-white">&copy; 2024 Agricazone. Tous droits réservés.
            </p>
        </div>
    </footer>
</body>

</html>