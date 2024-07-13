@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card border-customGreen-500" ">
        <div class=" card-header bg-customGreen-500 text-white text-center fs-1">
        <h1>Créer une reservation</h1>
    </div>
    <div class="row p-3">
        @foreach ($stocks as $stock)
        <!--afficher uniquement les stocks qui ont une quantité > 0 -->
        @if ($stock->quantity > 0)
        <div class="col-md-4 mb-3 mt-3 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $stock->product->name }}</h5>
                    <p class="card-text">Quantité: {{ $stock->quantity }} kg</p>
                    <p class="card-text">Prix: {{ $stock->price }} €/kg ou €/litre</p>
                    @foreach($users as $user)
                    @if($user->id == $stock->user_id)
                    <p class="card-text">Vendeur: {{ $user->name }} {{ $user->lastname }}</p>
                    @endif
                    @endforeach

                    <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                        <input type="hidden" name="total_price" id="hidden_total_price-{{ $stock->id }}">
                        <input type="hidden" name="status_id" value="3">

                        <div class="form-group">
                            <label for="quantity">Quantité</label>
                            <input type="number" id="quantity-{{ $stock->id }}" name="quantity" class="form-control quantity-input" data-price="{{ $stock->price }}" min="1" max="{{ $stock->quantity }}" required>
                        </div>
                        <div class="form-group">
                            <label for="total_price">Prix total</label>
                            <p class="card-text total-price" id="total_price-{{ $stock->id }}">0 €</p>
                        </div>

                        <div class="form-group">
                            <label for="collection_id">Point de vente</label>
                            <select name="collection_id" id="collection_id" class="form-control">
                                @foreach ($collections->where('user_id', $stock->user_id) as $collection)
                                <option value="{{ $collection->id }}">
                                    {{ $collection->adress }} {{ $collection->city }} {{ $collection->postalcode }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btnCustom mt-3">Réserver</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
</div>

<script>
    // Fonction pour mettre à jour le prix total
    function updateTotalPrice(event) {
        let quantity = parseInt(event.target.value);
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            event.target.value = 1;
        }

        let price = parseFloat(event.target.dataset.price);
        let total = (quantity * price).toFixed(2);

        let stockId = event.target.id.split('-')[1];
        document.getElementById('total_price-' + stockId).textContent = total + ' €';
        document.getElementById('hidden_total_price-' + stockId).value = total; // Mettre à jour l'input caché
    }

    // Ajouter un écouteur d'événement sur tous les champs quantity-input
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });

    // Calculer le prix total initial au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.quantity-input').forEach(input => {
            updateTotalPrice({
                target: input
            }); // Appel initial pour calculer le prix total au chargement
        });
    });
</script>

@endsection