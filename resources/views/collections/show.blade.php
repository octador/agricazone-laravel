@extends('layouts.app')

@section('title', 'Point de collecte')

@section('content')

<h1>Point de collecte n°{{ $collection->id }}</h1>

<p>Adresse: {{ $collection->adress }}</p>
<p>Ville: {{ $collection->city }}</p>
<p>Code postal: {{ $collection->postalcode }}</p>

<p>Crée le: {{ \Carbon\Carbon::parse($collection->created_at)->format('d/m/Y H:i:s') }}</p>
<p>Dernière mise à jour: {{ \Carbon\Carbon::parse($collection->updated_at)->format('d/m/Y H:i:s') }}</p>

<p>Utilisateur: {{ $collection->user->name }}</p>
<a href="{{ route('collections.edit', $collection->id) }}" class="btn btn-primary">Modifier le point de collecte <i class="fas fa-edit"></a>
<a href="{{ route('collections.index') }}" class="btn btn-primary">Retour à la liste des points de collecte</a>

@endsection