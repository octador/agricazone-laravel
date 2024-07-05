@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Stock</h1>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="products">
            @foreach ($products as $product)
            <div class="form-check product-item" data-category-id="{{ $product->category_id }}" style="display: none;">
                <input class="form-check-input" type="radio" name="product_id" id="product-{{ $product->id }}" value="{{ $product->id }}">
                <label class="form-check-label" for="product-{{ $product->id }}">
                    {{ $product->name }}
                </label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Stock</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const products = document.querySelectorAll('.product-item');
        const categorySelect = document.getElementById('category');
        categorySelect.value = null;

        categorySelect.addEventListener('change', function() {
            const selectedCategoryId = this.value;

            products.forEach(function(product) {
                if (product.getAttribute('data-category-id') === selectedCategoryId || selectedCategoryId === '') {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection