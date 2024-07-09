@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-5 container">
    <div class="card border-customGreen-500" style="width: 100%; max-width: 600px;">
        <div class="card-header bg-customGreen-500 text-white text-center fs-1">
            <h1>Modifier Réservation</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group fs-5 mb-3 d-flex justify-content-between">
                    <label for="product">Produit</label>
                    <input type="text" id="product" class="form-control border-customGreen-500 rounded-3xl text-center w-25" value="{{ $product->name }}" readonly>
                </div>

                <div class="form-group fs-5 mb-3 d-flex align-items-center ">
                    <label for="quantity" class="me-3">Quantité</label>
                    <div class="input-group w-">
                        <div class="input-group-prepend">
                            <button type="button" id="decrementQuantity" class="btn bg-customGreen-500 text-white hover:bg-customGreen-600">-</button>
                        </div>
                        <input type="number" id="quantity" name="quantity" class="form-control border-customGreen-500 text-center " value="{{ $reservation->quantity }}" min="1" required>
                        <div class="input-group-append">
                            <button type="button" id="incrementQuantity" class="btn bg-customGreen-500 text-white hover:bg-customGreen-600">+</button>
                        </div>
                    </div>
                </div>

                <div class="form-group fs-5 mb-3 d-flex justify-content-between">
                    <label for="price">Prix unitaire (€/kg)</label>
                    <input type="text" id="price" name="price" class="form-control border-customGreen-500 rounded-3xl w-25" value="{{ $stock->price }}" readonly>
                </div>

                <div class="form-group fs-5 mb-3 d-flex justify-content-between">
                    <label for="total_price">Prix total (€)</label>
                    <input type="text" id="total_price" name="total_price" class="form-control border-customGreen-500 w-25 rounded-3xl" value="{{ number_format($reservation->total_price, 2) }}" readonly>
                </div>

                <div class="form-group fs-5 mb-3">
                    <label for="collection_id">Point de vente</label>
                    <select name="collection_id" id="collection_id" class="form-control border-customGreen-500 rounded-3xl">
                        @foreach($collections as $collection)
                        <option value="{{ $collection->id }}" {{ $collection->id == $reservation->collection_id ? 'selected' : '' }}>{{ $collection->adress }} {{ $collection->city }} {{ $collection->postalcode }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn bg-customGreen-500 text-white hover:bg-customGreen-600 mt-4">Enregistrer les modifications</button>
            </form>

            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600">Supprimer la réservation</button>
            </form>
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
    document.getElementById('decrementQuantity').addEventListener('click', function() {
        let quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
            updateTotalPrice();
        }
    });

    document.getElementById('incrementQuantity').addEventListener('click', function() {
        let quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
        updateTotalPrice();
    });

    document.getElementById('quantity').addEventListener('input', function() {
        updateTotalPrice();
    });

    function updateTotalPrice() {
        let quantity = parseInt(document.getElementById('quantity').value);
        let price = parseFloat(document.getElementById('price').value);
        let total = (quantity * price).toFixed(2);
        document.getElementById('total_price').value = total;
    }
</script>
@endsection