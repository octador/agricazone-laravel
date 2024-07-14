<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agricazone - Plateforme de Réservation et de gestion de Produits Agricoles Locaux</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased">

    <div class="wrapper d-flex flex-column min-vh-100">

        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('images/logo_agricazone.png') }}" alt="logo agricazone" class="hover:text-gray-200">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                                    </svg>
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle mr-2" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg>
                                    Connectez-vous
                                </a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-vcard mr-2" viewBox="0 0 16 16">
                                        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5.5 0 0 1-.5-.5" />
                                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                    </svg>
                                    Inscription
                                </a>
                            </li>
                            @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-grow-1">
            <section class="jumbotron">
                <div class="container">
                    <h1 class="display-4 ">Bienvenue sur Agricazone</h1>
                    <p class="lead ">Votre plateforme pour réserver des produits agricoles locaux et avec une gestion des stocks pour les agriculteurs.</p>
                </div>
            </section>

            <section class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Réservez des Produits Agricoles Locaux</h2>
                            <p>Commandez des produits frais et locaux directement auprès de nos agriculteurs partenaires. Découvrez une variété de produits de saison et des points de collectes près de chez vous.</p>
                        </div>
                        <div class="col-md-6">
                            <h2>Gestion de Stock pour Agriculteurs</h2>
                            <p>Gérez efficacement votre stock avec notre outil intuitif. Suivez vos stocks, gérez les commandes et vos points de collectes pour optimiser votre activité agricole.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer text-center">
            <div class="container-fluid">
                <p class="mb-0">&copy; 2024 Agricazone. Tous droits réservés.</p>
            </div>
        </footer>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>