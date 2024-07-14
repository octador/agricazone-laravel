@extends('layouts.app')

@section('title', 'Point de collecte')

@section('content')
<div class="d-flex justify-content-center mt-5 container">
    <div class="card border-customGreen-500" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Point de collecte</h1>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <p class="fs-5 mb-1"><strong>Adresse :</strong> {{ $collection->adress }}</p>
                <p class="fs-5 mb-1"><strong>Ville :</strong> {{ $collection->city }}</p>
                <p class="fs-5 mb-1"><strong>Code postal :</strong> {{ $collection->postalcode }}</p>
            </div>

            <div class="mb-3">
                <p class="fs-5 mb-1"><strong>Créé le :</strong> {{ \Carbon\Carbon::parse($collection->created_at)->format('d/m/Y H:i:s') }}</p>
                <p class="fs-5 mb-1"><strong>Dernière mise à jour :</strong> {{ \Carbon\Carbon::parse($collection->updated_at)->format('d/m/Y H:i:s') }}</p>
            </div>

            <div class="mb-3">
                <p class="fs-5 mb-1"><strong>Utilisateur :</strong> {{ $collection->user->name }}</p>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('collections.edit', $collection->id) }}" class="btnCustomBlue d-flex align-items-center">
                    Modifier le point de collecte <i class="fas fa-edit ms-2"></i>
                </a>
                <a href="{{ route('collections.index') }}" class="btnCustom">Retour à la liste des points de collecte</a>
            </div>
        </div>
    </div>
</div>
@endsection