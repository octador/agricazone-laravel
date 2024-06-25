@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="card" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h1>Détails de la Réservation</h1>
        </div>
        <div class="card-body text-center">
            <svg width="100" height="100" viewBox="0 0 16 16" class="bi bi-box-seam mb-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.5.134a1 0 0 0-1 0l-6 3.46A1 0 0 0 1 4.461V10.5a1 0 0 0 .5.866l6 3.46a1 0 0 0 1 0l6-3.46A1 0 0 0 15 10.5V4.46a1 0 0 0-.5-.866l-6-3.46zM2.5 5.13v4.74L8 13.548V8.807L2.5 5.13zM8 7.193l5.5 3.678V5.13L8 1.807v5.386zm1-.928l4.5-2.9L8 1.193 3.5 3.365 8 6.265z" />
            </svg>
            <h3>Réservation ID: {{ $reservation->id }}</h3>
            <p>Produit: {{ $product->name }}</p>
            <p>Quantité: {{ $reservation->quantity }} kg</p>
            <p>Prix unitaire: {{ $stock->price }} €/kg</p>
            <p>Prix total: {{ number_format($reservation->total_price, 2) }} €</p>
            <p>Point de vente: {{ $collection->city }} {{$collection->postalcode}}</p>

            <p>Description des lieux : {{ $collection->description ?? 'Pas de description des lieux' }}</p>

            @if ($reservation->status_id == 1)
            <p>Status: Annullée</p>
            @elseif ($reservation->status_id == 2)
            <p>Status: Acceptée</p>
            @elseif ($reservation->status_id == 3)
            <p>Status: En attente</p>
            @endif
            <p>Date de création: {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i:s') }}</p>
            <p>Dernière mise à jour: {{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s') }}</p>
            <a href="{{ route('reservations.edit', $reservation->id,$reservation->quantity) }}" class="btn btn-primary mt-3">Modifier la Réservation <i class="fas fa-edit"></i"></a>
            <a href="{{ route('reservations.index') }}" class="btn btn-primary mt-3">Retour à la liste des réservations</a>
        </div>
    </div>
</div>
@endsection