@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center mt-5 container">
    <div class="card border-customGreen-500 " style="width: 100%; max-width: 600px;">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Création de point de collecte</h1>
        </div>
        <div class="p-3">

            <form action="{{route('collections.store')}}" method="post">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group text-customGreen-500">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control text-customGreen-500 border-customGreen-500 rounded-3xl" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group text-customGreen-500">
                    <label for="adress">Adresse</label>
                    <input type="text" class="form-control text-customGreen-500 border-customGreen-500 rounded-3xl" id="adress" name="adress">
                </div>

                <div class="form-group text-customGreen-500">
                    <label for="postalcode">Code postal</label>
                    <input type="text" class="form-control text-customGreen-500 border-customGreen-500 rounded-3xl" id="postalcode" name="postalcode">
                </div>

                <div class="form-group text-customGreen-500">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control text-customGreen-500 border-customGreen-500 rounded-3xl" id="city" name="city">
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btnCustom mt-3 mb-3">Créer un point de collecte</button>
                    <a href="{{ route('collections.index') }}" class="btnCustomRed mt-3 mb-3">Annuler</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection