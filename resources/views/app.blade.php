<!-- resources/views/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Ajoutez ici vos liens CSS, scripts JS, etc. -->
</head>

<body>

    <header>
        <!-- Ajoutez ici le contenu de votre en-tête -->
        <h1>@yield('title')</h1>
    </header>

    <main>
        <div class="container">
            <!--  page dynamique-->
            @yield('content')
        </div>
    </main>

    <footer>
        <!-- Ajoutez ici le contenu de votre pied de page -->
        <p>&copy; 2024 Agricazone</p>
    </footer>

</body>

</html>