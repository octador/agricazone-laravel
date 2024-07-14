@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">

    <div class="card border-customGreen-500">

        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Liste des points collections</h1>
        </div>

        <div class="p-3">
            <!-- Tableau pour les écrans moyens et plus grands -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Code postal</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collections as $collection)
                        <tr>
                            <th scope="row">{{ $collection->id }}</th>
                            <td>{{ $collection->name }}</td>
                            <td>{{ $collection->description }}</td>
                            <td>{{ $collection->adress }}</td>
                            <td>{{ $collection->postalcode }}</td>
                            <td>{{ $collection->city }}</td>
                            <td>


                                <div class="d-flex flex-column flex-md-row gap-2">
                                    <a href="{{ route('collections.show', $collection->id) }}" class="btnCustom">Détail</a>
                                    <a href="{{ route('collections.edit', $collection->id) }}" class="btnCustomBlue">Modifier</a>
                                    <form action="{{ route('collections.destroy', $collection->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce point de collecte ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btnCustomRed">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cartes pour les écrans plus petits -->
            <div class="d-block d-md-none">
                <div class="row">
                    @foreach ($collections as $collection)
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body border-2 border-customGreen-500 text-start ">

                                <p class="card-text"><strong>Ville:</strong> {{ $collection->city }}</p>
                                <p class="card-text"><strong>Adresse:</strong> {{ $collection->adress }}</p>
                                <p class="card-text"><strong>Code postal:</strong> {{ $collection->postalcode }}</p>
                                <p class="card-text"><strong>Description:</strong> {{ $collection->description }}</p>
                                <div class="d-flex flex-column gap-2 mt-3">
                                    <a href="{{ route('collections.show', $collection->id) }}" class="btnCustom">Détail</a>
                                    <a href="{{ route('collections.edit', $collection->id) }}" class="btnCustomBlue">Modifier</a>
                                    <form action="{{ route('collections.destroy', $collection->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce point de collecte ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btnCustomRed w-100">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3 mb-3">
                @if ($collections->hasPages())
                <p>
                    {{ $collections->links() }}
                </p>
                @else
                <p class="fs-5 mt-3 mb-3">Nombre de points de collecte: {{ $collections->count() }}</p>
                @endif

            </div>
        </div>

        <div class="d-flex justify-content-center mt-3 mb-3 gap-3">
            <a href="{{ route('collections.create') }}" class="btnCustom text-white">Ajouter un nouveau point de collecte</a>
            <a href="{{ route('dashboard') }}" class="btnCustomBlue text-white">Retour au dashboard</a>
        </div>
    </div>
</div>
@endsection