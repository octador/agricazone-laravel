<!-- resources/views/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/css/app.css" >
    <title>@yield('title')</title>
</head>

<body>

    <header>
        
        <h1>@yield('title')</h1>
    </header>

    <main>
        @if(session('success'))
        <div>
            <p>{{ session('success') }}</p>
        </div>
        @endif
        <div class="container">
           
            @yield('content')
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Agricazone</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>