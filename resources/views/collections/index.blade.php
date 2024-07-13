@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center mt-5 ">

    <div class="card border-customGreen-500 " style="width: 100%; max-width: 600px;">

        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Liste des points collections</h1>
        </div>

        <div class="p-3">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Adress</th>
                        <th scope="col">Code postal</th>
                        <th scope="col">Ville</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-3 mb-3">

                {{ $collections->links() }}
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 mb-3 gap-3">
            <a href="{{ route('collections.create') }}" class="btnCustom text-white"> Ajouter un nouveau point de collecte</a>
            <a href="{{ route('dashboard') }}" class="btnCustomBlue text-white"> Retour au dashboard</a>
        </div>
    </div>
</div>




@endsection