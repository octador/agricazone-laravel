@extends('layouts.app')

@section('content')

<div class="container mt-5 d-flex justify-content-center">
    <div class="card border-customGreen-500 shadow w-50">
        <div class=" bg-customGreen-500 text-white card-header text-center fs-1">
            <h1 class="card-title">Création de stock</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="form-group mb-3">
                    <label for="category" class="form-label text-customGreen-500">Category</label>
                    <select name="category" id="category" class="form-control ">
                        @foreach ($categories as $category)
                        @if($category->products->count() > 0)
                        <option value="{{ $category->id }}" class="text-customGreen-500">{{ $category->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div id="products" class="mb-3 text-customGreen-500">
                    @foreach ($products as $product)
                    <div class="form-check product-item" data-category-id="{{ $product->category_id }}" style="display: none;">
                        <input class="form-check-input text-customGreen-500" type="radio" name="product_id" id="product-{{ $product->id }}" value="{{ $product->id }}">
                        <label class="form-check-label text-customGreen-500" for="product-{{ $product->id }}">
                            {{ $product->name }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label text-customGreen-500">Description</label>
                    <input type="text" name="description" id="description" class="form-control text-customGreen-500 border-customGreen-500 rounded" required>
                </div>

                <div class="form-group mb-3 d-flex justify-content-between">
                    <label for="quantity" class="form-label text-customGreen-500">Quantity</label>
                    <div class="input-group w-25 gap-3">
                        <button type="button" class="btnCustom rounded shadow" id="decrement-quantity-btn"> - </button>
                        <input type="text" name="quantity" id="quantity" class=" border-none text-center form-control text-customGreen-500 border-customGreen-500 rounded" required pattern="[0-9]*">
                        <button type="button" class="btnCustom rounded shadow" id="increment-quantity-btn"> + </button>
                    </div>
                </div>

                <div class="form-group mb-3 d-flex justify-content-between">
                    <label for="price" class="form-label text-customGreen-500">Prix</label>
                    <div class="input-group w-25 gap-3 ">
                        <button type="button" class="btnCustom rounded shadow" id="decrement-price-btn">-</button>
                        <input type="number" name="price" id="price" class=" border-none text-center form-control text-customGreen-500 border-customGreen-500 " step="0.01" min="0" required>
                        <button type="button" class="btnCustom rounded shadow" id="increment-price-btn">+</button>
                    </div>
                </div>
                <div class="d-flex justify-content-center">

                    <button type="submit" class="btnCustom shadow">Créer un nouveau stock</button>
                </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const quantityInput = document.getElementById('quantity');
        const priceInput = document.getElementById('price');
        const incrementQuantityBtn = document.getElementById('increment-quantity-btn');
        const decrementQuantityBtn = document.getElementById('decrement-quantity-btn');
        const incrementPriceBtn = document.getElementById('increment-price-btn');
        const decrementPriceBtn = document.getElementById('decrement-price-btn');

        quantityInput.value = '1'; // Valeur par défaut pour la quantité
        priceInput.value = '0.00'; // Valeur par défaut pour le prix

        categorySelect.value = null;


        categorySelect.addEventListener('change', function() {
            const selectedCategoryId = this.value;
            const products = document.querySelectorAll('.product-item');

            products.forEach(function(product) {
                if (product.getAttribute('data-category-id') === selectedCategoryId || selectedCategoryId === '') {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });

        incrementQuantityBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value) || 0;
            quantityInput.value = currentValue + 1;
        });

        decrementQuantityBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value) || 0;
            if (currentValue > 0) {
                quantityInput.value = currentValue - 1;
            }
        });

        incrementPriceBtn.addEventListener('click', function() {
            let currentValue = parseFloat(priceInput.value) || 0;
            priceInput.value = (currentValue + 0.01).toFixed(2);
        });

        decrementPriceBtn.addEventListener('click', function() {
            let currentValue = parseFloat(priceInput.value) || 0;
            if (currentValue > 0) {
                priceInput.value = (currentValue - 0.01).toFixed(2);
            }
        });
    });
</script>

@endsection