@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5">Recherche de Réservations</h1>
    
    @if($reservations->isEmpty())
        <div class="alert alert-info text-center">
            Aucune réservation trouvée.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Réservation</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Quantité (kg)</th>
                        <th>Prix Total (€)</th>
                        <th>Point de Vente</th>
                        <th>Status</th>
                        <th>Date de Création</th>
                        <th>Dernière Mise à Jour</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        @php
                            $stock = $stocks->firstWhere('id', $reservation->stock_id);
                            $custommer = $custommers->firstWhere('id', $reservation->user_id);
                        @endphp
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $custommer->name }}</td>
                            <td>{{ $stock->product->name }}</td>
                            <td>{{ $reservation->quantity }}</td>
                            <td>{{ number_format($reservation->total_price, 2) }}</td>
                            <td>{{ $reservation->collection->city }} {{ $reservation->collection->postalcode }}</td>
                            <td>
                                @if ($reservation->status_id == 1)
                                    Commande recupérer
                                @elseif ($reservation->status_id == 2)
                                    Commande validée
                                @elseif ($reservation->status_id == 3)
                                    En attente de preparation
                                    <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm">Prêt</a>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-primary btn-sm">Voir</a>
                                <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
