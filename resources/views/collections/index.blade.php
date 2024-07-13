@extends('layouts.app')

@section('content')

<h1>La page collection</h1>



<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Adress</th>
            <th scope="col">Code postal</th>
            <th scope="col">Ville</th>
            <th scope="col">Utilisateur</th>
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
            <td>{{ $collection->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('collections.create') }}" class="btnCustom"> Ajouter un nouveau point de collecte</a>



@endsection