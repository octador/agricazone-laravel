@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-5 ">
    <div class="card border-customGreen-500 shadow " style="width: 100%; max-width: 600px;">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Détails de la Réservation</h1>
        </div>

        <div class="card-body justify-center grid grid-row-1">
            <div class="flex justify-center">
                <div>
                    <h3>Réservation ID: {{ $reservation->id }}</h3>
                    <p>Produit: {{ $product->name }}</p>
                    <p>Quantité: {{ $reservation->quantity }} kg</p>
                    <p>Prix unitaire: {{ $stock->price }} €/kg</p>
                    <p>Prix total: {{ number_format($reservation->total_price, 2) }} €</p>
                    <p>Point de vente: {{ $collection->city }} {{ $collection->postalcode }}</p>

                    <p>Description des lieux: {{ $collection->description ?? 'Pas de description des lieux' }}</p>

                    <p> status:
                        @if($status->state == "pending")
                        <span class="badge bg-secondary text-dark text-white">En cours</span>
                        @elseif($status->state == "validate")
                        <span class="badge bg-customGreen-500 text-white">Validé</span>
                        @elseif($status->state == "cancel")
                        <span class="badge bg-danger text-white">Annulé</span>
                        @endif
                    </p>
                    <p>Date de création: {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i:s') }}</p>
                    <p>Dernière mise à jour: {{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3">

                @if (auth()->user()->role_id == 3)
                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btnCustom mt-3 shadow">Modifier la Réservation <i class="fas fa-edit"></i></a>
                @endif

                @if (auth()->user()->role_id == 2)
                <a href="{{route('reservations.search', $reservation->id) }}" class="btnCustomBlue text-white mt-3 shadow">Retour</a>
                @else
                <a href="{{ route('reservations.index') }}" class="btnCustomBlue text-white mt-3 shadow">Retour à la liste des réservations</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection