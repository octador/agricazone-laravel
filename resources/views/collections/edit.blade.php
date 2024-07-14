@extends('layouts.app')

@section('title', 'Edition d\'un point de collecte')

@section('content')
<h1>Édition d'un point de collecte</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('collections.update', $collection) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ $collection->description }}">
    </div>
    <div class="form-group">
        <label for="adress">Adresse</label>
        <input type="text" class="form-control" id="adress" name="adress" value="{{ $collection->adress }}">
    </div>

    <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" class="form-control" id="city" name="city" value="{{ $collection->city }}">
    </div>

    <div class="form-group">
        <label for="postalcode">Code postal</label>
        <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ $collection->postalcode }}">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection