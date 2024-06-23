<!-- resources/views/products/search.blade.php -->
@extends('app')

@section('title', 'Produits de la catégorie')

@section('content')

    <h1>Produits de la catégorie : {{ $category->name }}</h1>

    @if($category->products->isEmpty())
        <p>Aucun produit trouvé pour cette catégorie.</p>
    @else
        <ul>
            @foreach ($category->products as $product)
                <li>{{ $product->name }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('products.index') }}">Retour à la liste des produits</a>
@endsection