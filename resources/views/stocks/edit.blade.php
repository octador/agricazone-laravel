@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card shadow border-customGreen-500">
                <div class="card-header bg-customGreen-500 text-white text-center">
                    <h1 class="card-title fs-1">Éditer votre stock</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('stocks.update', $stock->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="is_available" value="{{ $stock->is_available }}">

                        <div class="form-group mb-3">
                            <label for="product_id" class="form-label text-customGreen-500">Produit :</label>
                            <select name="product_id" id="product_id" class="form-control text-customGreen-500 border-customGreen-500 rounded-3xl">
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label text-customGreen-500 text-customGreen-500">Description :</label>
                            <input type="text" class="form-control text-customGreen-500 border-customGreen-500 rounded-3xl " id="description" name="description" value="{{ old('description', $stock->description) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-customGreen-500">Quantité :</label>
                            <div class="d-flex align-items-center text-customGreen-500">
                                <button type="button" class="btnCustom rounded shadow " onclick="changeQuantity(-1)">-</button>
                                <input type="hidden" id="quantity" name="quantity" value="{{ $stock->quantity }}">
                                <span id="quantityDisplay" class="mx-3">{{ $stock->quantity }}</span>
                                <button type="button" class="btnCustom rounded shadowy" onclick="changeQuantity(1)">+</button>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label text-customGreen-500">Prix (€) :</label>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btnCustom rounded shadow" onclick="changePrice(-0.01)">-</button>
                                <input type="hidden" id="price" name="price" value="{{ $stock->price }}">
                                <span id="priceDisplay" class="mx-3 text-customGreen-500">{{ $stock->price }}</span>
                                <button type="button" class="btnCustom rounded shadow" onclick="changePrice(0.01)">+</button>
                            </div>
                        </div>
                        <div class="flex justify-content-center ">
                            <button type="submit" class="btnCustom shadow">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeQuantity(amount) {
        var quantityInput = document.getElementById('quantity');
        var quantityDisplay = document.getElementById('quantityDisplay');
        var currentValue = parseInt(quantityInput.value);
        var newValue = currentValue + amount;
        if (newValue >= 0) {
            quantityInput.value = newValue;
            quantityDisplay.textContent = newValue;
        }
    }

    function changePrice(amount) {
        var priceInput = document.getElementById('price');
        var priceDisplay = document.getElementById('priceDisplay');
        var currentValue = parseFloat(priceInput.value);
        var newValue = currentValue + amount;
        if (newValue >= 0) {
            priceInput.value = newValue.toFixed(2); // Limite à 2 décimales
            priceDisplay.textContent = newValue.toFixed(2);
        }
    }
</script>
@endsection