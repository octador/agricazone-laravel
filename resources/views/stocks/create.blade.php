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


                            <!-- Vérifier si le produit de la catégorie est supérieur à zéro. 
                        Si c'est le cas, alors le produit sera affiché dans le select -->
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

                    <div class="form-group mb-3  ">
                        <label for="description" class="form-label text-customGreen-500">Description</label>
                        <input type="text" name="description" id="description" class="form-control text-customGreen-500 border-customGreen-500 rounded" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="quantity" class="form-label text-customGreen-500">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control text-customGreen-500 border-customGreen-500 rounded" required min="1">
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="form-label text-customGreen-500">Prix</label>
                        <input type="number" name="price" id="price" class="form-control text-customGreen-500 border-customGreen-500 rounded" step="0.01" min="0" required>
                    </div>

                    <button type="submit" class="btnCustom">Créer un nouveau stock</button>
                </form>
            </div>
        </div>
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