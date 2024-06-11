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
        <h1>Agricazone</h1>
    </header>

    <main>
        <!-- Contenu dynamique de la page -->
        @yield('content')
    </main>

    <footer>
        <!-- Ajoutez ici le contenu de votre pied de page -->
        <p>&copy; 2024 Mon Application</p>
    </footer>

</body>

</html>