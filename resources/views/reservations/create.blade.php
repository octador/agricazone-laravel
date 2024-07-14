@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center mt-5 container">
    <div class="card border-customGreen-500" style="width: 100%; max-width: 800px;">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Créer une réservation</h1>
        </div>

        <div class="card-body p-3">
            <div class="row">
                @foreach ($stocks as $stock)
                <!-- Afficher uniquement les stocks qui ont une quantité > 0 -->
                @if ($stock->quantity > 0)
                <div class="col-md-6 mb-3 mt-3">
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

                                <div class="form-group fs-5 mb-3 d-flex align-items-center justify-content-between">
                                    <label for="quantity-{{ $stock->id }}" class="me-3">Quantité</label>
                                    <div class="input-group w-50">
                                        <div class="input-group-prepend">
                                            <button type="button" id="decrementQuantity-{{ $stock->id }}" class="btnCustom px-3">-</button>
                                        </div>
                                        <input type="number" id="quantity-{{ $stock->id }}" name="quantity" class="form-control border-none text-center quantity-input" data-price="{{ $stock->price }}" min="1" max="{{ $stock->quantity }}" value="1" required>
                                        <div class="input-group-append">
                                            <button type="button" id="incrementQuantity-{{ $stock->id }}" class="btnCustom px-3">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group fs-5 mb-3 d-flex justify-content-between">
                                    <label for="total_price-{{ $stock->id }}">Prix total</label>
                                    <p class="card-text total-price w-50 text-end" id="total_price-{{ $stock->id }}">0 €</p>
                                </div>

                                <div class="form-group fs-5 mb-3">
                                    <label for="collection_id-{{ $stock->id }}">Point de vente</label>
                                    <select name="collection_id" id="collection_id-{{ $stock->id }}" class="form-control border-customGreen-500 rounded-3xl">
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

            <div class="d-flex justify-content-end p-3">
                @if ($stocks->hasPages())
                {{ $stocks->links() }}
                @else
                <p class="text-center">Tous les stocks sont affichés</p>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
    /* Style pour masquer les flèches de contrôle dans l'input de type number */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>

<script>
    // Fonction pour mettre à jour le prix total
    function updateTotalPrice(stockId) {
        let quantityInput = document.getElementById('quantity-' + stockId);
        let quantity = parseInt(quantityInput.value);
        let price = parseFloat(quantityInput.dataset.price);
        let total = (quantity * price).toFixed(2);

        document.getElementById('total_price-' + stockId).textContent = total + ' €';
        document.getElementById('hidden_total_price-' + stockId).value = total; // Mettre à jour l'input caché
    }

    // Ajouter des écouteurs d'événements sur tous les champs quantity-input et boutons
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', function() {
            updateTotalPrice(input.id.split('-')[1]);
        });
    });

    document.querySelectorAll('.btnCustom').forEach(button => {
        button.addEventListener('click', function() {
            let stockId = button.id.split('-')[1];
            let quantityInput = document.getElementById('quantity-' + stockId);
            let quantity = parseInt(quantityInput.value);

            if (button.id.startsWith('decrementQuantity')) {
                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                    updateTotalPrice(stockId);
                }
            } else if (button.id.startsWith('incrementQuantity')) {
                quantityInput.value = quantity + 1;
                updateTotalPrice(stockId);
            }
        });
    });

    // Calculer le prix total initial au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.quantity-input').forEach(input => {
            updateTotalPrice(input.id.split('-')[1]); // Appel initial pour calculer le prix total au chargement
        });
    });
</script>

@endsection