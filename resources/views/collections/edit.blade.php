@extends('layouts.app')

@section('title', 'Édition d\'un point de collecte')

@section('content')
<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="card border-customGreen-500 " style=" width: 100%; max-width: 600px;">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1 rounded-3xl">
            <h1>Édition d'un point de collecte</h1>
        </div>

        <div class="card-body">
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
                <div class="form-group mb-3">
                    <label for="description" class="text-customGreen-500">Description</label>
                    <input type="text" class="form-control border-2 border-customGreen-500 text-customGreen-500 rounded-3xl" id="description" name="description" value="{{ $collection->description }}">
                </div>
                <div class="form-group mb-3">
                    <label for="adress" class="text-customGreen-500">Adresse</label>
                    <input type="text" class="form-control border-2 border-customGreen-500 text-customGreen-500 rounded-3xl" id="adress" name="adress" value="{{ $collection->adress }}">
                </div>

                <div class="form-group mb-3">
                    <label for="city" class="text-customGreen-500">Ville</label>
                    <input type="text" class="form-control border-2 border-customGreen-500 text-customGreen-500 rounded-3xl" id="city" name="city" value="{{ $collection->city }}">
                </div>

                <div class="form-group mb-3">
                    <label for="postalcode" class="text-customGreen-500">Code postal</label>
                    <input type="text" class="form-control border-2 border-customGreen-500 text-customGreen-500 rounded-3xl" id="postalcode" name="postalcode" value="{{ $collection->postalcode }}">
                </div>
                <div class="d-flex justify-content-center">
                    
                    <button type="submit" class="btnCustom">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection