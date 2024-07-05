@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-4 text-center mb-4">Editer votre stock</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
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
                    <label for="quantity">Quantité</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $stock->quantity) }}" required>
                </div>
                <div class="form-group">
                    <label for="price">Prix</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $stock->price) }}" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-4">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
@endsection
