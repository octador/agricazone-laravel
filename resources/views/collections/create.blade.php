@extends('layouts.app')

@section('content')

<h1>création collection</h1>

<form action="{{route('collections.store')}}" method="post">
    @csrf

    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="adress">Adresse</label>
        <input type="text" class="form-control" id="adress" name="adress">
    </div>

    <div class="form-group">
        <label for="postalcode">Code postal</label>
        <input type="text" class="form-control" id="postalcode" name="postalcode">
    </div>

    <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" class="form-control" id="city" name="city">
    </div>

    <button type="submit" class="btnCustom mt-3">Créer</button>
</form>

@endsection