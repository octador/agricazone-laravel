@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5 container">
    <div class="card border-customGreen-500 w-full">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1 class="text-center text-white text-center fs-1">Mes Réservations</h1>
        </div>

        @if($reservations->isEmpty())
        <div class="alert alert-info text-center">
            Aucune réservation trouvée.
        </div>
        @else
        <!-- Tableau pour les écrans moyens et plus grands -->
        <div class="table-responsive d-none d-md-block p-3">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Quantité (kg)</th>
                        <th>Prix Total (€)</th>
                        <th>Point de Vente</th>
                        <th>Status</th>
                        <th>Création</th>
                        <th>Mise à Jour</th>
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
                        <td class="text-wrap">{{ $custommer->name }} - {{ $custommer->lastname }}</td>
                        <td class="text-wrap">{{ $stock->product->name }}</td>
                        <td>{{ $reservation->quantity }}</td>
                        <td>{{ number_format($reservation->total_price, 2) }}</td>
                        <td class="text-wrap">{{ $reservation->collection->adress }} - {{ $reservation->collection->city }} {{ $reservation->collection->postalcode }}</td>
                        <td class="text-wrap">
                            @if ($reservation->status_id == 1)
                            Réservation récupérée
                            <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm  mt-1">Oups la commande n'a pas été récupérée</a>
                            @elseif ($reservation->status_id == 2)
                            Réservation prête
                            <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm  mt-1">Le client récupère sa commande</a>
                            @elseif ($reservation->status_id == 3)
                            En attente de préparation
                            <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm  mt-1">Prêt</a>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s') }}</td>
                        <td class="text-wrap">
                            <div class="d-flex flex-column gap-2">
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-primary btn-sm mb-1 w-100">Voir</a>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Card pour les écrans plus petits -->
        <div class="d-block d-md-none">
            @foreach($reservations as $reservation)
            @php
            $stock = $stocks->firstWhere('id', $reservation->stock_id);
            $custommer = $custommers->firstWhere('id', $reservation->user_id);
            @endphp
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Réservation #{{ $reservation->id }}</h5>
                    <p class="card-text"><strong>Client:</strong> {{ $custommer->name }} {{ $custommer->lastname }}</p>
                    <p class="card-text"><strong>Téléphone : </strong> {{ $custommer->phone }}</p>
                    <p class="card-text"><strong>Produit:</strong> {{ $stock->product->name }}</p>
                    <p class="card-text"><strong>Quantité:</strong> {{ $reservation->quantity }} kg</p>
                    <p class="card-text"><strong>Prix Total:</strong> {{ number_format($reservation->total_price, 2) }} €</p>
                    <p class="card-text"><strong>Point de Vente:</strong> {{ $reservation->collection->adress }} - {{ $reservation->collection->city }} {{ $reservation->collection->postalcode }}</p>
                    <p class="card-text"><strong>Status:</strong>
                        @if ($reservation->status_id == 1)
                        Réservation récupérée
                        <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm mt-1">Oups la commande n'a pas été récupérée</a>
                        @elseif ($reservation->status_id == 2)
                        Réservation prête
                        <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm mt-1">Le client récupère sa commande</a>
                        @elseif ($reservation->status_id == 3)
                        En attente de préparation
                        <a href="{{ route('status.update', $reservation->id) }}" class="btn btn-primary btn-sm mt-1">Prêt</a>
                        @endif
                    </p>
                    <p class="card-text"><strong>Date de Création:</strong> {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i:s') }}</p>
                    <p class="card-text"><strong>Dernière Mise à Jour:</strong> {{ \Carbon\Carbon::parse($reservation->updated_at)->format('d/m/Y H:i:s') }}</p>
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-primary btn-sm mb-1">Voir</a>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection