@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-4 text-center mb-4">Éditer votre stock</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 border rounded p-4">
            <form method="POST" action="{{ route('stocks.update', $stock->id) }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="is_available" value="{{ $stock->is_available }}">

                <div class="form-group">
                    <label for="product_id">Produit</label>
                    <select name="product_id" id="product_id" class="form-control">
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $stock->description) }}" required>
                </div>

                <div class="form-group">
                    <div class="d-flex gap-4">

                        <label>Quantité : </label>
                        <div class="d-flex gap-4">
                            <div>
                                <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">-</button>
                            </div>
                            <p id="quantityDisplay">{{ $stock->quantity }}</p>
                            <input type="hidden" id="quantity" name="quantity" value="{{ $stock->quantity }}">
                            <div>
                                <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class=" d-flex gap-4">
                        <label>Prix : </label>
                        <div>
                            <button type="button" class="btn btn-outline-secondary" onclick="changePrice(-0.01)">-</button>
                        </div>
                        <p id="priceDisplay">{{ $stock->price }}</p>
                        <input type="hidden" id="price" name="price" value="{{ $stock->price }}">
                        <div>
                            <button type="button" class="btn btn-outline-secondary" onclick="changePrice(0.01)">+</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Enregistrer</button>
            </form>
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